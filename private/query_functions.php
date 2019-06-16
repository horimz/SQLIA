<?php

/* Users */

// Finds user by username (safe version)
function find_user_by_username($username) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);

    return $user; // returns an assoc. array
}

// Finds user by username (vulnerable version)
function find_user_by_username_vulnerable_version($username) {
  global $db;

  $sql = "SELECT * FROM users WHERE username='" . $username . "'";
  echo "<br>";
  print($sql);
  echo "<br>";
  
  $required_string = ';';
  if (has_string($username, $required_string)) {
    $result = mysqli_multi_query($db, $sql); // multiple query 
  } else {
    $result = mysqli_query($db, $sql);  // single query  
  }

  // $result = mysqli_query($db, $sql);  // single query
  // $result = mysqli_multi_query($db, $sql); // multiple query 
  confirm_result_set($result);

  return $result;
}

// Finds user by username (fixed vulnerable version by adding machine learning filter)
function find_user_by_username_filter_version($username) {
  global $db;

  // Filtering
  exec('python sql_filter.py "' .  $username . '"', $output, $ret_code);
  print("User input type: ");
  print($output[0]);

  $sql = "SELECT * FROM users WHERE username='" . $username . "'";
  echo "<br>";
  print($sql);
  echo "<br>";

  if ($ret_code == 0) {
    $required_string = ';';
    if (has_string($username, $required_string)) {
      $result = mysqli_multi_query($db, $sql); // multiple query 
    } else {
      $result = mysqli_query($db, $sql);  // single query  
    }
  } else {
    exit("Invalid database query.");
  } 

  // $result = mysqli_query($db, $sql);  // single query
  // $result = mysqli_multi_query($db, $sql); // multiple query 
  confirm_result_set($result);

  return $result;
}


// Finds user by user id
function find_user_by_id($id) {
  global $db;

  $sql = "SELECT * FROM users ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $user = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  
  return $user; // returns an assoc. array
}

function insert_user($user) {
    global $db;

    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users ";
    $sql .= "(username, hashed_password, email) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $user['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "',";
    $sql .= "'" . db_escape($db, $user['email']) . "'";
    $sql .= ")";
    
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}

function update_user($user) {
    global $db;

    $password_sent = !is_blank($user['password']);

    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

    $sql = "UPDATE users SET ";
    $sql .= "username='" . db_escape($db, $user['username']) . "' ";
    $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "', ";
    $sql .= "WHERE id='" . db_escape($db, $user['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}

function delete_user($user) {
    global $db;

    $sql = "DELETE FROM users ";
    $sql .= "WHERE id='" . db_escape($db, $user['id']) . "' ";
    $sql .= "LIMIT 1;";

    $result = mysqli_query($db, $sql);
    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}

?>