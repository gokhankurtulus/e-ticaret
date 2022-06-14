<?php
require_once 'define.php';

require_once "App/User.php";
try {
    $userClass = new User();
    $users = $userClass->getAllUsers();
} catch (Exception $ex) {
}
?>
    <link rel="stylesheet" href="assets/css/main.css">
    <style>
        body {
            background: var(--background);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 1200px;
            max-width: 1200px;
        }

        section {
            background: var(--grey);
        }

        #users {
            border-collapse: collapse;
            width: 100%;
        }

        #users td, #users th {
            border: 1px solid var(--darkGrey);
            padding: .5em;
        }

        #users tr:nth-child(even) {
            background-color: var(--paleBlue);
            color: var(--white);
        }

        #users tr:hover {
            background-color: var(--white);
            color: var(--dark);
        }

        #users th {
            text-align: left;
            background-color: var(--blue);
            color: var(--white);
        }

    </style>

<?php
if (!empty($users)):
    ?>
    <div class="container">
        <table id="users">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Identity</th>
                <th>Status</th>
                <th>Mail</th>
                <th>Phone</th>
                <th>Date of Birth</th>
                <th>City</th>
                <th>Address</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->getID(); ?></td>
                    <td><?= $user->getUsername(); ?></td>
                    <td><?= $user->getName(); ?></td>
                    <td><?= $user->getSurname(); ?></td>
                    <td><?= $user->getIdentity(); ?></td>
                    <td><?= $user->getStatus(); ?></td>
                    <td><?= $user->getMail(); ?></td>
                    <td><?= $user->getPhone(); ?></td>
                    <td><?= $user->getBirthDate(); ?></td>
                    <td><?= $user->getCity(); ?></td>
                    <td><?= $user->getFullAddress(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php else: ?>
    <p>Users not found.</p>
<?php endif; ?>