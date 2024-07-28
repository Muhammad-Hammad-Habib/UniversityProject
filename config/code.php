<?php

    // ========== Connect Databse ==========
    include('config.php');


    if (isset($_POST['search_action'])) {
        $found = $db->query('SELECT * FROM users WHERE (first_name LIKE "%'.$_POST['search_bar'].'%") OR (last_name LIKE "%'.$_POST['search_bar'].'%")');

        if ($found) {
            $data1 = [];
            foreach ($found as $data2) {
                $data1[] = $data2;
            }
            echo json_encode($data1);
        }else{
            echo json_encode(['message' => 'No User Found']);
        }
    }

    
    // ========== Register ==========
    if (isset($_POST['first_name'])) {
        // print_r($_POST);

        $first_name = $db->real_escape_string($_POST['first_name']);
        $last_name = $db->real_escape_string($_POST['last_name']);
        $email = $db->real_escape_string($_POST['email']);
        $password = $db->real_escape_string($_POST['password']);
        $confirm_password = $db->real_escape_string($_POST['confirm_password']);
        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";

        if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password)) {
            echo "All Fields Are Required";
        }
        else{
            if (preg_match($password_regex, $password) === 0) {
                echo "<ul>
                    <li>Password must be at least 8 characters long</li>
                  <li>At least one uppercase English letter</li>
                    <li>At least one lowercase English letter</li>
                    <li>At least one digit</li>
                    <li>At least one special character</li>
                </ul>";
            }
            else{
                if ($password !== $confirm_password) {
                    echo "Passwords Doesn't Matched";
                }
                else{
                    $check_email = $db->query('SELECT * FROM users WHERE email = "'.$email.'"');

                    if ($check_email->num_rows > 0) {
                        echo 'Email Already Exists';
                    }
                    else{
                        $inserted = $db->query('INSERT INTO users (first_name, last_name, email, password) VALUES ("'.$first_name.'","'.$last_name.'","'.$email.'","'.password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]).'")');

                        if ($inserted) {
                            echo 'success';
                        }
                        else{
                            echo 'Something Went Wrong';
                        }
                    }
                }
            }
        }
    }





    // // ========== Login ==========
    if (isset($_POST['_email'])) {
        $email = $db->real_escape_string($_POST['_email']);
        $password = $db->real_escape_string($_POST['_password']);

        if (empty($email) || empty($password)) {
            echo "All Fields Are Required";
        }
        else{
            $check_login = $db->query('SELECT * FROM users WHERE email = "'.$email.'"');

            if ($check_login->num_rows > 0) {
                $row = $check_login->fetch_assoc();
                $hashed_password = $row['password'];

                $verify_pass = password_verify($password, $hashed_password);

                if ($verify_pass == true) {
                    $_SESSION['user'] = $row['id'];
                    echo 'success';
                }
                else {
                    echo 'Incorrect password';
                }
            }
            else{
                echo 'Login Failed';
            }
        }
    }
    




    // // ========== Get User ==========
    // if (isset($_POST['get_user'])) {
    //     $query = $db->query('SELECT * FROM users WHERE id = "'.$_SESSION['user'].'"');
    //     echo json_encode($query->fetch_assoc());
    // }





    // ========== Update Profile Picture ==========
    if (isset($_POST['update_profile_img'])) {
        $img_name = $_FILES['profile_img']['name'];
        $img_temp = $_FILES['profile_img']['tmp_name'];

        $check_img = $db->query("SELECT * FROM users WHERE id = '".$_SESSION['user']."'");
        $get_old_img = $check_img->fetch_assoc();

        if ($get_old_img['image']!="") {
            unlink('../public/storage/profile/'.$get_old_img['image']);
        }

        $update = $db->query("UPDATE users SET image = '".$img_name."' WHERE id = '".$_SESSION['user']."'");

        if ($update) {
            $uploaded = move_uploaded_file($img_temp, '../public/storage/profile/'.$img_name);
            if ($uploaded) {
                echo "Success Uploaded";
            }else{
                echo "Error Uploaded";
            }
        }else{
            echo 'Updating Failed';
        }
    }
    




    // ========== Update Cover Picture ==========
    if (isset($_POST['update_cover_img'])) {
        $img_name = $_FILES['cover_img']['name'];
        $img_temp = $_FILES['cover_img']['tmp_name'];

        $check_img = $db->query("SELECT * FROM users WHERE id = '".$_SESSION['user']."'");
        $get_old_img = $check_img->fetch_assoc();

        if ($get_old_img['cover_image']!="") {
            unlink('../public/storage/cover/'.$get_old_img['cover_image']);
        }

        $update = $db->query("UPDATE users SET cover_image = '".$img_name."' WHERE id = '".$_SESSION['user']."'");

        if ($update) {
            $uploaded = move_uploaded_file($img_temp, '../public/storage/cover/'.$img_name);
            if ($uploaded) {
                echo "Success Uploaded";
            }else{
                echo "Error Uploaded";
            }
        }else{
            echo 'Updating Failed';
        }
    }





    // ========== Update Intro Video ==========
    if (isset($_POST['update_intro_video'])) {
        $video_name = $_FILES['intro_video']['name'];
        $video_temp = $_FILES['intro_video']['tmp_name'];

        $check_video = $db->query("SELECT * FROM users WHERE id = '".$_SESSION['user']."'");
        $get_old_video = $check_video->fetch_assoc();

        if ($get_old_video['intro_video']!="") {
            unlink('../public/storage/video/'.$get_old_video['intro_video']);
        }

        $update = $db->query("UPDATE users SET intro_video = '".$video_name."' WHERE id = '".$_SESSION['user']."'");

        if ($update) {
            $uploaded = move_uploaded_file($video_temp, '../public/storage/video/'.$video_name);
            if ($uploaded) {
                echo "Success Uploaded";
            }else{
                echo "Error Uploaded";
            }
        }else{
            echo 'Updating Failed';
        }
    }






    // // ========== Update Cover Picture ==========
    // if (isset($_POST['update_cover_img'])) {

    //     $img_name = $_FILES['cover_img']['name'];
    //     $img_temp = $_FILES['cover_img']['tmp_name'];

    //     $check_img = $db->query('SELECT * FROM users WHERE id = "'.$_SESSION['user'].'"');
    //     $info = $check_img->fetch_assoc();

    //     if ($check_img->num_rows > 0) {
    //         $query = $db->query('UPDATE users SET cover_image = "'.$img_name.'" WHERE id = "'.$_SESSION['user'].'"');
    //         if ($query) {
    //             $uploaded = move_uploaded_file($img_temp, '../uploads/cover/'.$img_name);
    //             if ($uploaded) {
    //                 echo "Success Uploaded";
    //             }
    //             else{
    //                 echo "Error Uploaded";
    //             }
    //         }
    //     }
    // }






    // ========== Update User ==========
    if (isset($_POST['edit_first_name'])) {

        $first_name = $db->real_escape_string($_POST['edit_first_name']);
        $last_name = $db->real_escape_string($_POST['edit_last_name']);
        $email = $db->real_escape_string($_POST['edit_email']);
        $address = $db->real_escape_string($_POST['edit_address']);

        $check_email = $db->query('SELECT * FROM users WHERE email = "'.$email.'" && id != "'.$_SESSION['user'].'"');

        if ($check_email->num_rows > 0) {
            echo 'Email Already Exist';
        }
        else{
            $query = $db->query('UPDATE users SET first_name = "'.$first_name.'", last_name = "'.$last_name.'", email = "'.$email.'", address = "'.$address.'" WHERE id = "'.$_SESSION['user'].'"');

            if ($query) {
                echo 'Personal Info Successfully Updated';
            }
            else{
                echo 'Something Went Wrong';
            }
        }
    }







    // ========== Add About ==========
    if (isset($_POST['edit_about'])) {
        $about = $db->real_escape_string($_POST['edit_about']);
        $query = $db->query('UPDATE users SET about = "'.$about.'" WHERE id = "'.$_SESSION['user'].'"');

        if ($query) {
            echo 'About Successfully Updated';
        }
    }









    // ========== Add About ==========
    if (isset($_POST['edit__education'])) {
        $education = $db->real_escape_string($_POST['edit__education']);
        $location = $db->real_escape_string($_POST['edit__location']);
        $notes = $db->real_escape_string($_POST['edit__notes']);

        $query_1 = $db->query('SELECT * FROM about_me WHERE user_id = "'.$_SESSION['user'].'"');

        if ($query_1->num_rows > 0) {
            $query_2 = $db->query('UPDATE about_me SET education = "'.$education.'", location = "'.$location.'", notes = "'.$notes.'" WHERE user_id = "'.$_SESSION['user'].'"');

            if ($query_2) {
                echo 'About Me Successfully Updated';
            }
        }else{
            $query_2 = $db->query('INSERT INTO about_me (user_id, education, location, notes) VALUES ("'.$_SESSION['user'].'", "'.$education.'", "'.$location.'", "'.$notes.'")');

            if ($query_2) {
                echo 'About Me Successfully Inserted';
            }
        }
    }
    








    // ========== Add User Education ==========
    if (isset($_POST['program'])) {
        $program = $db->real_escape_string($_POST['program']);
        $institute = $db->real_escape_string($_POST['institute']);
        $start_date = $db->real_escape_string($_POST['start_date']);
        $id = $_POST['edu_id'];
        $end_date = "";
        $present = "";

        if (isset($_POST['end_date'])) {
            $end_date .= $db->real_escape_string($_POST['end_date']);
        }

        if (isset($_POST['present'])) {
            $present .= $db->real_escape_string($_POST['present']);
        }

        if ($id!="") {
            $update = $db->query('UPDATE education SET user_id = "'.$_SESSION['user'].'", program = "'.$program.'", institute = "'.$institute.'", start_date = "'.$start_date.'", end_date = "'.$end_date.'", present = "'.$present.'" WHERE id = "'.$id.'"');
            if ($update) {
                echo 'Education Successfully Updated';
            }
        }
        else{
            $insert = $db->query('INSERT INTO education (user_id, program, institute, start_date, end_date, present) VALUES ("'.$_SESSION['user'].'", "'.$program.'", "'.$institute.'" , "'.$start_date.'", "'.$end_date.'", "'.$present.'")');
            if ($insert) {
                echo 'Education Successfully Added';
            }
        }
    }











    // ========== Add User Certificate ==========
    if (isset($_POST['cer_program'])) {
        $program = $db->real_escape_string($_POST['cer_program']);
        $institute = $db->real_escape_string($_POST['cer_institute']);
        $issue_date = $db->real_escape_string($_POST['cer_issue_date']);
        $id = $_POST['cer_id'];

        if ($id!="") {
            $update = $db->query('UPDATE certificate SET user_id = "'.$_SESSION['user'].'", program = "'.$program.'", institute = "'.$institute.'", issue_date = "'.$issue_date.'" WHERE id = "'.$id.'"');
            if ($update) {
                echo 'Certificate Successfully Updated';
            }
        }
        else{
            $insert = $db->query('INSERT INTO certificate (user_id, program, institute, issue_date) VALUES ("'.$_SESSION['user'].'", "'.$program.'", "'.$institute.'" , "'.$issue_date.'")');
            if ($insert) {
                echo 'Certificate Successfully Added';
            }
        }
    }
    






    // ========== Edit Education ==========
    if (isset($_POST['edit_education'])) {
        $id = $db->real_escape_string($_POST['id']);
        $query = $db->query('SELECT * FROM education WHERE id = "'.$id.'" && user_id = "'.$_SESSION['user'].'"');
        $data = [];
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }






    // ========== Edit Education ==========
    if (isset($_POST['edit_certificate'])) {
        $id = $db->real_escape_string($_POST['id']);
        $query = $db->query('SELECT * FROM certificate WHERE id = "'.$id.'" && user_id = "'.$_SESSION['user'].'"');
        $data = [];
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }
    





    // ========== Edit Education ==========
    if (isset($_POST['edit_language'])) {
        $id = $db->real_escape_string($_POST['id']);
        $query = $db->query('SELECT * FROM languages WHERE id = "'.$id.'" && user_id = "'.$_SESSION['user'].'"');
        $data = [];
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }






    // ========== Delete Education ==========
    if (isset($_POST['delete_education'])) {
        $id = $db->real_escape_string($_POST['id']);
        $query = $db->query('DELETE FROM education WHERE user_id = "'.$_SESSION['user'].'" && id = "'.$id.'"');
        if ($query) {
            echo 'Education Successfully Deleted';
        }
    }
    





    // ========== Delete Education ==========
    if (isset($_POST['delete_certificate'])) {
        $id = $db->real_escape_string($_POST['id']);
        $query = $db->query('DELETE FROM certificate WHERE user_id = "'.$_SESSION['user'].'" && id = "'.$id.'"');
        if ($query) {
            echo 'Certificate Successfully Deleted';
        }
    }









    // ========== Delete Education ==========
    if (isset($_POST['delete_skill'])) {
        $id = $db->real_escape_string($_POST['id']);
        $query = $db->query('DELETE FROM skills WHERE user_id = "'.$_SESSION['user'].'" && id = "'.$id.'"');
        if ($query) {
            echo 'Skill Successfully Deleted';
        }
    }







    







    // // ========== Add User Location ==========
    // if (isset($_POST['location_action'])) {
    //     $location = $db->real_escape_string($_POST['location']);
    //     $location_id = $db->real_escape_string($_POST['location_id']);

    //     $query = $db->query('INSERT INTO location (user_id, location) VALUES ("'.$location_id.'", "'.$location.'")');
    //     if ($query) {
    //         echo 'Location Successfully Added';
    //     }
    // }







    // // ========== Get User ==========
    // if (isset($_POST['get_user_education'])) {
    //     $query = $db->query('SELECT * FROM education WHERE user_id = "'.$_SESSION['user'].'"');
    //     $data = [];
    //     while ($row = $query->fetch_assoc()) {
    //         $data[] = $row;
    //     }
    //     echo json_encode($data);
    // }







    // // ========== Get User Location ==========
    // if (isset($_POST['get_user_location'])) {

    //     $id = $db->real_escape_string($_POST['id']);
    //     $query = $db->query('SELECT * FROM location WHERE user_id = "'.$id.'"');
    //     $data = [];
    //     while ($row = $query->fetch_assoc()) {
    //         $data[] = $row;
    //     }

    //     echo json_encode($data);
    // }
    








    // ========== Add Experience ==========
    if (isset($_POST['position_name'])) {
        $position_name = $db->real_escape_string($_POST['position_name']);
        $company_name = $db->real_escape_string($_POST['company_name']);
        $timing = $db->real_escape_string($_POST['timing']);
        $start_date = $db->real_escape_string($_POST['start_date']);
        $id = $_POST['exp_id'];
        $end_date = "";
        $present = "";

        if (isset($_POST['end_date'])) {
            $end_date .= $db->real_escape_string($_POST['end_date']);
        }

        if (isset($_POST['present'])) {
            $present .= $db->real_escape_string($_POST['present']);
        }

        if ($id!="") {
            $update = $db->query('UPDATE experience SET user_id = "'.$_SESSION['user'].'", position_name = "'.$position_name.'", company_name = "'.$company_name.'", timing = "'.$timing.'", start_date = "'.$start_date.'", end_date = "'.$end_date.'", present = "'.$present.'" WHERE id = "'.$id.'"');
            if ($update) {
                echo 'Experience Successfully Updated';
            }
        }
        else{
            $insert = $db->query('INSERT INTO experience (user_id, position_name, company_name, timing, start_date, end_date, present) VALUES ("'.$_SESSION['user'].'", "'.$position_name.'", "'.$company_name.'", "'.$timing.'", "'.$start_date.'", "'.$end_date.'", "'.$present.'")');
            if ($insert) {
                echo 'Experience Successfully Added';
            }
        }
    }






    // // ========== Get Experience ==========
    // if (isset($_POST['get_experience'])) {

    //     $query = $db->query('SELECT * FROM experience WHERE user_id = "'.$_SESSION['user'].'"');
    //     $data = [];
    //     while ($row = $query->fetch_assoc()) {
    //         $data[] = $row;
    //     }

    //     echo json_encode($data);
    // }







    // ========== Edit Experience ==========
    if (isset($_POST['edit_experience'])) {
        $id = $_POST['id'];
        $query = $db->query('SELECT * FROM experience WHERE id = "'.$id.'" && user_id = "'.$_SESSION['user'].'"');
        $data = [];
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }





    // ========== Edit Portfolio ==========
    if (isset($_POST['edit_portfolio'])) {
        $id = $_POST['id'];
        $query = $db->query('SELECT * FROM portfolio WHERE id = "'.$id.'" && user_id = "'.$_SESSION['user'].'"');
        $data = [];
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }







    // ========== Edit Portfolio ==========
    if (isset($_POST['edit_about_me'])) {
        $query = $db->query('SELECT * FROM about_me WHERE user_id = "'.$_SESSION['user'].'"');
        $data = [];
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }






    if (isset($_POST['edit_skill'])) {
        $query = $db->query('SELECT * FROM skills WHERE id = "'.$_POST['id'].'"');
        $data = [];
        while ($row = $query->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    }




    // ========== Delete Experience ==========
    if (isset($_POST['delete_experience'])) {
        $id = $db->real_escape_string($_POST['id']);
        $query = $db->query('DELETE FROM experience WHERE user_id = "'.$_SESSION['user'].'" && id = "'.$id.'"');
        if ($query) {
            echo 'Experience Successfully Deleted';
        }
    }
    



    // ========== Delete Language ==========
    if (isset($_POST['delete_language'])) {
        $id = $db->real_escape_string($_POST['id']);
        $query = $db->query('DELETE FROM languages WHERE user_id = "'.$_SESSION['user'].'" && id = "'.$id.'"');
        if ($query) {
            echo 'Experience Successfully Deleted';
        }
    }
    



    // ========== Delete Portfolio ==========
    if (isset($_POST['delete_portfolio'])) {
        $id = $db->real_escape_string($_POST['id']);
        $query = $db->query('DELETE FROM portfolio WHERE user_id = "'.$_SESSION['user'].'" && id = "'.$id.'"');
        if ($query) {
            echo 'Portfolio Successfully Deleted';
        }
    }
        








    // ========== Add Skill ==========
    if (isset($_POST['skill'])) {
        $skill = $db->real_escape_string($_POST['skill']);
        $percent = $db->real_escape_string($_POST['percent']);

        if ($_POST['skill_id'] && $_POST['skill_id']!="") {
            $query = $db->query('UPDATE skills SET user_id = "'.$_SESSION['user'].'", skill = "'.$skill.'", percent = "'.$percent.'" WHERE id = "'.$_POST['skill_id'].'"');
            if ($query) {
                echo 'Skill Successfully Updated';
            }
        }
        else{
            $query = $db->query('INSERT INTO skills (user_id, skill, percent) VALUES ("'.$_SESSION['user'].'", "'.$skill.'", "'.$percent.'")');
            if ($query) {
                echo 'Skill Successfully Added';
            }
        }
    }










    // ========== Add Skill ==========
    if (isset($_POST['language'])) {
        $language = $db->real_escape_string($_POST['language']);

        if ($_POST['lang_id'] && $_POST['lang_id']!="") {
            $query = $db->query('UPDATE languages SET user_id = "'.$_SESSION['user'].'", language = "'.$language.'" WHERE id = "'.$_POST['lang_id'].'"');
            if ($query) {
                echo 'Language Successfully Updated';
            }
        }
        else{
            $query = $db->query('INSERT INTO languages (user_id, language) VALUES ("'.$_SESSION['user'].'", "'.$language.'")');
            if ($query) {
                echo 'Language Successfully Added';
            }
        }
    }
            








    // ========== Change Password ==========
    if (isset($_POST['current_pass'])) {
        $current_pass = $db->real_escape_string($_POST['current_pass']);
        $new_pass = $db->real_escape_string($_POST['new_pass']);
        $confirm_pass = $db->real_escape_string($_POST['confirm_pass']);
        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
    
        $query = $db->query('SELECT * FROM users WHERE id = "'.$_SESSION['user'].'"');

        $row = $query->fetch_assoc();
        $hashed_password = $row['password'];

        $verify_pass = password_verify($current_pass, $hashed_password);

        if ($verify_pass == true) {
            if (preg_match($password_regex, $new_pass) === 0) {
                echo "<ul>
                    <li>Password must be at least 8 characters long</li>
                    <li>At least one uppercase English letter</li>
                    <li>At least one lowercase English letter</li>
                    <li>At least one digit</li>
                    <li>At least one special character</li>
                </ul>";
            }
            else{
                if ($new_pass !== $confirm_pass) {
                    echo 'Passwords Doen\'t Matched';
                }
                else{
                    $query_1 = $db->query('UPDATE users SET password = "'.password_hash($new_pass, PASSWORD_BCRYPT, ['cost' => 12]).'" WHERE id = "'.$_SESSION['user'].'"');
                    if ($query_1) {
                        echo 'Password Successfully Changed';
                    }
                }
            }
        }
        else {
            echo 'Incorrect password';
        }
    }






    // // ========== Get Experience ==========
    // if (isset($_POST['get_skills'])) {

    //     $query = $db->query('SELECT * FROM skills WHERE user_id = "'.$_SESSION['user'].'"');
    //     $data = [];
    //     while ($row = $query->fetch_assoc()) {
    //         $data[] = $row;
    //     }

    //     echo json_encode($data);
    // }







    // // ========== Edit Experience ==========
    // if (isset($_POST['edit_experience'])) {
    //     $id = $db->real_escape_string($_POST['id']);
    //     $query = $db->query('SELECT * FROM experience WHERE id = "'.$id.'" && user_id = "'.$_SESSION['user'].'"');
    //     $data = [];
    //     while ($row = $query->fetch_assoc()) {
    //         $data[] = $row;
    //     }
    //     echo json_encode($data);
    // }




    // // ========== Delete Experience ==========
    // if (isset($_POST['delete_experience'])) {
    //     $id = $db->real_escape_string($_POST['id']);
    //     $query = $db->query('DELETE FROM experience WHERE user_id = "'.$_SESSION['user'].'" && id = "'.$id.'"');
    //     if ($query) {
    //         echo 'Experience Successfully Deleted';
    //     }
    // }







        // ========== Portfolio Form ==========
        if (isset($_POST['portfolio_action'])) {
            error_reporting(0);
            $title = $db->real_escape_string($_POST['port_title']);
            $desc = $db->real_escape_string($_POST['port_desc']);
            $url = $db->real_escape_string($_POST['port_url']);

            if ($_POST['port_id'] && $_POST['port_id']!="") {
                $check_img = $db->query("SELECT * FROM portfolio WHERE id = '".$_POST['port_id']."'");
                $get_old_img = $check_img->fetch_assoc();
                $update = "";

                if ($_FILES['port_image'] && $_FILES['port_image']['name']!="") {
                    if ($get_old_img['image']!="") {
                        unlink('../public/storage/portfolio/'.$get_old_img['image']);
                    }
                    $img_name = $_FILES['port_image']['name'];
                    $img_temp = $_FILES['port_image']['tmp_name'];
                    $update .= $db->query("UPDATE portfolio SET user_id = '".$_SESSION['user']."', title = '".$title."', description = '".$desc."', url = '".$url."', image = '".$img_name."' WHERE id = '".$_POST['port_id']."'");
                }else{                    
                    $update .= $db->query("UPDATE portfolio SET user_id = '".$_SESSION['user']."', title = '".$title."', description = '".$desc."', url = '".$url."' WHERE id = '".$_POST['port_id']."'");
                }

                if ($update) {
                    move_uploaded_file($img_temp, '../public/storage/portfolio/'.$img_name);
                    echo "Portfolio updated successfully";
                }
            }
            else{
                $img_name = $_FILES['port_image']['name'];
                $img_temp = $_FILES['port_image']['tmp_name'];
                $inserted = $db->query('INSERT INTO portfolio (user_id, title, description, url, image) VALUES ("'.$_SESSION['user'].'", "'.$title.'", "'.$desc.'", "'.$url.'", "'.$img_name.'")');

                if ($inserted) {
                    $uploaded = move_uploaded_file($img_temp, '../public/storage/portfolio/'.$img_name);
                    if ($uploaded) {
                        echo "Portfolio inserted successfully";
                    }else{
                        echo "Portfolio inserting failed";
                    }
                }
            }
        }
?>