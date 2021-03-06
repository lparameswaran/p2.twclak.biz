<?php
class posts_controller extends base_controller {

    public function __construct() {
        parent::__construct();

        # Make sure user is logged in if they want to use anything in this controller
        if(!$this->user) {
            Router::redirect("/");
        }
    }

    public function add($errorcode = 0) {

        # Setup view
        $this->template->content = View::instance('v_posts_add');
        $this->template->title   = "New Post";
        if ($errorcode == 1) {
           $this->template->content->error = "Post must contain atleast 2 words.";
        } else if ($errorcode == 2) {
           $this->template->content->error = "Post should be less than 255 characters.";
        }

        # Render template
        echo $this->template;

    }

    public function p_add() {

        # Associate this post with this user
        $_POST['user_id']  = $this->user->user_id;

        $_POST = DB::instance(DB_NAME)->sanitize($_POST);
        if (!preg_match("/\S+\s+\S+/", $_POST['content'])) {
           Router::redirect("/posts/add/1");
        }
        if (strlen($_POST['content']) > 254) {
           Router::redirect("/posts/add/2");
        }

        # Unix timestamp of when this post was created / modified
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();

        DB::instance(DB_NAME)->insert('posts', $_POST);

        Router::redirect("/posts/");
    }

    public function index() {

        # Set up the View
        $this->template->content = View::instance('v_posts_index');
        $this->template->title   = "All Posts";

        # Build the query
        $q = 'SELECT 
            posts.content,
            posts.created,
            posts.user_id AS post_user_id,
            posts.post_id AS post_id,
            users_users.user_id AS follower_id,
            users.first_name,
            users.last_name
        FROM posts
        INNER JOIN users_users 
            ON posts.user_id = users_users.user_id_followed
        INNER JOIN users 
            ON posts.user_id = users.user_id
        WHERE users_users.user_id = '.$this->user->user_id;

        # Run the query
        $posts = DB::instance(DB_NAME)->select_rows($q);

        $q = "SELECT
                post_id,
                likes,
                rating
              FROM users_posts
              WHERE user_id = ". $this->user->user_id;
        $likes_ratings = DB::instance(DB_NAME)->select_rows($q);
    
        # Pass data to the View
        $this->template->content->posts = $posts;
        $this->template->content->likes_ratings = $likes_ratings;
        $this->template->content->this_user_id = $this->user->user_id;

        # Render the View
        echo $this->template;

     }

     public function users() {
 
        # Set up the View
        # CSS/JS includes

        $client_files = Array(
                              "main_theme" => "/css/main.css"
                             );
        $this->template->client_files_head = Utils::load_client_files($client_files);

        $client_files_head_script = "";
        $this->template->client_files_head_script = $client_files_head_script;

        $this->template->content = View::instance("v_posts_users");
        $this->template->title   = "Users";

        # Build the query to get all the users
        $q = "SELECT *
            FROM users";

        # Execute the query to get all the users. 
        # Store the result array in the variable $users
        $users = DB::instance(DB_NAME)->select_rows($q);

        # Build the query to figure out what connections does this user already have? 
        # I.e. who are they following
        $q = "SELECT * 
            FROM users_users
            WHERE user_id = ".$this->user->user_id;

        # Execute this query with the select_array method
        # select_array will return our results in an array and use the "users_id_followed" field as the index.
        # This will come in handy when we get to the view
        # Store our results (an array) in the variable $connections
        $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

        # Pass data (users and connections) to the view
        $this->template->content->users       = $users;
        $this->template->content->connections = $connections;

        # Render the view
        echo $this->template;
     }

     public function follow($user_id_followed) {

        # Prepare the data array to be inserted
        $data = Array(
            "created" => Time::now(),
            "user_id" => $this->user->user_id,
            "user_id_followed" => $user_id_followed
            );

        # Do the insert
        DB::instance(DB_NAME)->insert('users_users', $data);

        # Send them back
        Router::redirect("/posts/users");

    }

    public function unfollow($user_id_followed) {
        # Delete this connection
        $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
        DB::instance(DB_NAME)->delete('users_users', $where_condition);

        # Send them back
        Router::redirect("/posts/users");
    }

    public function like($post_id_followed) {
        $q = "SELECT user_post_id
            FROM users_posts
            WHERE user_id = ".$this->user->user_id . " AND post_id=" . $post_id_followed;

        $user_post = DB::instance(DB_NAME)->select_field($q);
        if ($user_post) {
           # Do the update
           $data = Array("likes" => 1);
           $where_condition = ' WHERE user_post_id='.$user_post;
           DB::instance(DB_NAME)->update('users_posts', $data, $where_condition);
        } else {
           # Prepare the data array to be inserted
           $data = Array(
               "post_id" => $post_id_followed,
               "user_id" => $this->user->user_id,
               "likes" => 1,
               "rating" => 0
               );
           DB::instance(DB_NAME)->insert('users_posts', $data);
        }

        Router::redirect("/posts");
    }

    public function dislike($post_id_followed) {
        $q = "SELECT user_post_id
            FROM users_posts
            WHERE user_id = ".$this->user->user_id . " AND post_id=" . $post_id_followed;

        $user_post = DB::instance(DB_NAME)->select_field($q);
        if ($user_post) {
           # Do the update
           $data = Array("likes" => 0);
           $where_condition = ' WHERE user_post_id='.$user_post;
           DB::instance(DB_NAME)->update('users_posts', $data, $where_condition);
        } else {
           # Prepare the data array to be inserted
           $data = Array(
               "post_id" => $post_id_followed,
               "user_id" => $this->user->user_id,
               "likes" => 0,
               "rating" => 0
               );
           DB::instance(DB_NAME)->insert('users_posts', $data);
        }

        Router::redirect("/posts");
    }

    public function rate($post_id_followed) {
        $q = "SELECT user_post_id
            FROM users_posts
            WHERE user_id = ".$this->user->user_id . " AND post_id=" . $post_id_followed;

        $user_post = DB::instance(DB_NAME)->select_field($q);
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);
        if ($user_post) {
           # Do the update
           $data = Array("rating" => $_POST["rating"]);
           $where_condition = ' WHERE user_post_id='.$user_post;
           DB::instance(DB_NAME)->update('users_posts', $data, $where_condition);
        } else {
           # Prepare the data array to be inserted
           $data = Array(
               "post_id" => $post_id_followed,
               "user_id" => $this->user->user_id,
               "likes" => 1,
               "rating" => $_POST["rating"]
               );
           DB::instance(DB_NAME)->insert('users_posts', $data);
        }

        Router::redirect("/posts");
    }

    public function delete($post_id) {
        $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND post_id = '.$post_id;
        DB::instance(DB_NAME)->delete('posts', $where_condition);
        
        Router::redirect("/posts");

    }
}
?>
