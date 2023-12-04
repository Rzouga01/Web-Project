<?php
include '../../Controller/ParticipationC.php';
require_once '../../model/Participation.php';
include '../../Controller/EventC.php';
require_once '../../model/Event.php';

$partC = new ParticipationC();
$listparts = $partC->getByUserId(1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Participations</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            color: #333;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h2>Your Participations</h2>
<br>
<br>
<hr>
<hr>
    <table>
        <thead>
            <tr>
                <th>Event</th>
                <th>Etat</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listparts as $key) : ?>
                <tr>
                    <td>
                        <?php
                        $eventC = new EventC();
                        $event = $eventC->getOneById($key['id_event']);
                        echo $event['Event_name'];
                        ?>
                    </td>
                    <td>
                        <?php if ($key['etat'] == 0) : ?>
                            Pending
                        <?php elseif ($key['etat'] == 1) : ?>
                            Done
                        <?php endif; ?>
                    </td>
                    <td>
                        <a onclick="confirmDelete(<?php echo $key['id'] ?>)">Supprimer</a>
                        
<script>
    function confirmDelete(eventId) {
        var confirmation = confirm("Are you sure you want to delete this participation?");
        
        if (confirmation) {
            // If the user clicks "OK" in the confirmation popup, proceed with the deletion
            window.location.href = "deleteparc.php?id=" + eventId;
        } else {
            // If the user clicks "Cancel" in the confirmation popup, do nothing
            // You can optionally provide feedback or take other actions here
        }
    }
</script>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
