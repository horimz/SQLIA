<?php


/* ---------------------------- Card ---------------------------- */
function find_all_cards() {
    global $db;
    $sql = "SELECT * FROM card ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}
// function oci_find_all_cards() {
//   global $db;
  
//   $sql = "SELECT * FROM card ";
//   $sql = "ORDER BY id ACS";
//   $result = OCIParse($db, $sql);
//   OCIExecute($result);
//   return $result;
// }
function insert_card($card) {
  global $db;
  $sql = "INSERT INTO card ";
  $sql .= "(name, type, benefit_id, company_id) ";
  $sql .= "VALUES (";
  // $sql .= "'" . db_escape($db, $card['id']) . "',";
  $sql .= "'" . db_escape($db, $card['name']) . "',";
  $sql .= "'" . db_escape($db, $card['type']) . "',";
  $sql .= "'" . db_escape($db, $card['benefit_id']) . "',";
  $sql .= "'" . db_escape($db, $card['company_id']) . "'";
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
function update_card($card) {
  global $db;
  $sql = "UPDATE card SET ";
  $sql .= "name='" . db_escape($db, $card['name']) . "', ";
  $sql .= "type='" . db_escape($db, $card['type']) . "', ";
  $sql .= "benefit_id='" . db_escape($db, $card['benefit_id']) . "' ";
  $sql .= "WHERE id='" . db_escape($db, $card['id']) . "' ";
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
function delete_card($id) {
  global $db;
  $sql = "DELETE FROM card ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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
function find_card_by_id($id) {
  global $db;
  $sql = "SELECT * FROM card ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $card = mysqli_fetch_assoc($result); // find first
  mysqli_free_result($result);
  return $card; // returns an assoc. array
}
function find_cards_by_franchise_id($id) {
  global $db;
  $sql = "SELECT * FROM card ";
  $sql .= "WHERE id IN ";
  $sql .= "(SELECT card_id FROM affiliate ";
  $sql .= "WHERE franchise_id='" . db_escape($db, $id) . "') ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}
function find_cards_by_benefit_id($id) {
  global $db;
  $sql = "SELECT * FROM card ";
  $sql .= "WHERE benefit_id='" . db_escape($db, $id) . "' ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}
/* ---------------------------- Franchise ---------------------------- */
function find_all_franchise() {
  global $db;
  $sql = "SELECT * FROM franchise ";
  $sql .= "ORDER BY id ASC";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}
function find_franchise_by_id($id) {
    global $db;
    $sql = "SELECT * FROM franchise ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $franchise = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $franchise; // returns an assoc. array
} 
function insert_franchise($franchise) {
  global $db;
  $sql = "INSERT INTO franchise ";
  $sql .= "(name, type) ";
  $sql .= "VALUES (";
  // $sql .= "'" . db_escape($db, $franchise['id']) . "',";
  $sql .= "'" . db_escape($db, $franchise['name']) . "',";
  $sql .= "'" . db_escape($db, $franchise['type']) . "'";
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
function update_franchise($franchise) {
  global $db;
  $sql = "UPDATE franchise SET ";
  $sql .= "name='" . db_escape($db, $franchise['name']) . "', ";
  $sql .= "type='" . db_escape($db, $franchise['type']) . "' ";
  $sql .= "WHERE id='" . db_escape($db, $franchise['id']) . "' ";
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
function delete_franchise($franchise) {
  global $db;
  $sql = "DELETE FROM franchise ";
  $sql .= "WHERE id='" . db_escape($db, $franchise) . "' ";
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
function find_franchise_id_by_franchisee_id($id) {
  global $db;
  $sql = "SELECT franchise_id FROM franchisee ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $franchise = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $franchise; // returns an assoc. array
}









/* Users */

function find_all_users() {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY id ASC";
    
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
}

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

function insert_user($user) {
    global $db;

    $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users ";
    $sql .= "(username, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $user['username']) . "',";
    $sql .= "'" . db_escape($db, $hashed_password) . "'";
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