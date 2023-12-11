<?php
function insert($website_url, $website_name,$email,$username,$user_password,$account_comment) {
    try {
        $db = new PDO(
            "mysql:host=" . DBHOST . "; dbname=" . DBNAME . ";charset=utf8",
            DBUSER,
            DBPASS
        );

        $statement = $db -> prepare("INSERT INTO account_entry (website_url,website_name,username,user_password,account_comment)VALUES (:website_url, :website_name,:username,AES_ENCRYPT(:user_password,'key'),:account_comment); INSERT INTO user_info(email) VALUES(:email)");
        $statement -> execute(
            array(
                'website_url'   => $website_url,
                'website_name' => $website_name,
                'email' => $email,
                'username' => $username,
                'user_password' => $user_password,
                'account_comment' => $account_comment
            )
        );
    } catch(PDOException $e) {
        echo '<p>The following message was generated by function <code>insert</code>:</p>' . "\n";
        echo '<p id="error">' . $e -> getMessage() . '</p>' . "\n";

        exit;
    }
}

function search ($search){
    try {
        $db = new PDO(
            "mysql:host=" . DBHOST . "; dbname=" . DBNAME . ";charset=utf8",
            DBUSER,
            DBPASS
        );

        $select_query= "SELECT user_id, website_url, website_name,email, username, AES_DECRYPT(user_password,'key') , account_comment FROM everything WHERE website_url LIKE \"%{$search} %\"OR website_name LIKE \"%{$search}%\" OR username LIKE \"%{$search}%\"
        OR user_password LIKE AES_ENCRYPT('{$search}','key') OR account_comment LIKE \"%{$search}%\" OR email LIKE \"%{$search}%\"";

        $statement = $db->prepare($select_query);
        $statement->execute();

        if (count($statement->fetchAll()) == 0) {
            return 0;
        } else {
            echo "      <table>\n";
            echo "        <thead>\n";
            echo "          <tr>\n";
            echo "            <th>User ID </th>\n";
            echo "            <th>Website URL</th>\n";
            echo "            <th>Website Name</th>\n";
            echo "            <th>Email</th>\n";
            echo "            <th>Username</th>\n";
            echo "            <th>User Password</th>\n";
            echo "            <th>Account Comment </th>\n";
            echo "          </tr>\n";
            echo "        </thead>\n";
            echo "        <tbody>\n";

            foreach ($db->query($select_query) as $row) {
                echo "          <tr>\n";
                echo "            <td>" . htmlspecialchars($row[0]) . "</td>\n";
                echo "            <td>" . htmlspecialchars($row[1]) . "</td>\n";
                echo "            <td>" . htmlspecialchars($row[2]) . "</td>\n";
                echo "            <td>" . htmlspecialchars($row[3]) . "</td>\n";
                echo "            <td>" . htmlspecialchars($row[4]) . "</td>\n";
                echo "            <td>" . htmlspecialchars($row[5]) . "</td>\n";
                echo "            <td>" . htmlspecialchars($row[6]) . "</td>\n";

                echo "          </tr>\n";
            }

            echo "         </tbody>\n";
            echo "      </table>\n";
        }

    } catch (PDOException $error) {
        echo '<p>The following message was generated by function <code>search</code>:</p>' . "\n";
        echo $error->getMessage();
        echo "<p>not working</p>";
        exit;
    }
}

function delete($current_attribute, $match){
    try{
        $db = new PDO (
            "mysql:host=" . DBHOST . ";dbname=" . DBNAME. ";charset=utf8",
            DBUSER,
            DBPASS
        );
        $db->query("DELETE account_entry,user_info FROM account_entry JOIN user_info ON account_entry.user_ip=user_info.user_id WHERE {$current_attribute}=\"{$match}\"");
 } catch(PDOException $e) {
    echo '<p>The following message was generated by function <code>delete</code>:</p>' . "\n";
    echo '<p id="error">' . $e -> getMessage() . '</p>' . "\n";

    exit;
   }
}

function update($current_attribute, $new_attribute, $query_attribute, $match)
{
    {
        try {
            $db = new PDO(
                "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8",
                DBUSER,
                DBPASS
            );

            $db -> query("UPDATE account_entry JOIN user_info ON account_entry.user_ip=user_info.user_id SET {$current_attribute}=\"{$new_attribute}\"  WHERE {$query_attribute}=\"{$match}\"");
        } catch
        (PDOException $e) {
            echo '<p>The following message was generated by function <code>update</code>:</p>' . "\n";
            echo '<p id="error">' . $e->getMessage() . '</p>' . "\n";

            exit;
        }
    }
}
