<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Schedule</title>
    <!-- Included DataTables library -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body>
    <section id="main" class="d-flex align-items-center">
        <div class="container-fluid">
            <div class="col-lg-12">
                <?php if(isset($_SESSION['login_id'])): ?>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Button to link to another page -->
                        <a href="add_events.html" class="btn btn-primary btn-md">Add New</a>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="card col-md-12">
                        <div class="card-header">
                            <div class="card-title"><b>Events List</b></div>
                            <div class="help"><b>Here is a list of upcoming events. Feel free to reserve a ticket</b></div>
                            <div class="help"><b>Click on an event to get more info and reserve</b></div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-striped" id="schedule-field">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">Event Name</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Time</th>
                                        <th class="text-center">Location</th>
                                        <?php if(isset($_SESSION['login_id'])): ?> <!-- Check if user is logged in -->
                                            <th class="text-center">Actions</th> <!-- New column for actions -->
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be populated dynamically -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Included jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Included DataTables library -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#new_schedule').click(function(){
                // Assuming uni_modal is defined elsewhere
                uni_modal('Add New Schedule','add_events.html');
            });

            // Load schedule function
            function load_schedule() {
                $('#schedule-field').dataTable().fnDestroy();
                $('#schedule-field tbody').html('<tr><td colspan="6" class="text-center">Please wait...</td></tr>');
                $.ajax({
                    url: 'load_schedule.php',
                    error: function(err) {
                        console.log(err);
                        alert_toast('An error occurred.', 'danger');
                    },
                    success: function(resp) {
                        if (resp) {
                            resp = JSON.parse(resp);
                            if (Object.keys(resp).length > 0) {
                                $('#schedule-field tbody').html('');
                                Object.keys(resp).map(function(k) {
                                    var tr = $('<tr></tr>');
                                    tr.append('<td class="text-center">' + resp[k].Name + '</td>');
                                    tr.append('<td class="text-center">' + resp[k].Date + '</td>');
                                    tr.append('<td class="text-center">' + resp[k].Time + '</td>');
                                    tr.append('<td class="text-center">' + resp[k].Location + '</td>');
                                    <?php if(isset($_SESSION['login_id'])): ?> // Check if user is logged in
                                        tr.append('<td class="text-center"><a href="edit_event.php?Name=' + resp[k].Name + '">Edit</a> | <a href="delete_event.php?Name=' + resp[k].Name + '">Delete</a></td>'); // New column for actions
                                    <?php endif; ?>
                                    tr.attr('data-name', resp[k].Name); // Change data-id to data-name
                                    $('#schedule-field tbody').append(tr);
                                });

                                // Add event listener to rows
                                $('#schedule-field tbody tr').click(function() {
                                    var eventName = $(this).attr('data-name'); // Change eventId to eventName
                                    window.location.href = 'event_details.php?Name=' + eventName; // Change parameter to 'name'
                                });
                            } else {
                                $('#schedule-field tbody').html('<tr><td colspan="5" class="text-center"><b>THERE\'S NO DATA HERE!!</b>.</td></tr>');
                            }
                        }
                    },
                    complete: function() {
                        $('#schedule-field').dataTable();
                    }
                });
            }
            
            // Call the load_schedule function when the document is ready
            load_schedule();
        });
    </script>
</body>
</html>
