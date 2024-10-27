<?php include 'server.php'; ?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP mini crud</title>

    <!-- DaisyUI and Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
</head>

<body>
    <header>
        <div class="flex flex-col p-4 gap-2 bg-green-500">
            <label class="flex items-center justify-center space-x-3 p-2 backdrop-blur-sm bg-white/50 w-[160px] rounded-lg text-black">
                <span>Light</span>
                <input type="checkbox" class="toggle" id="theme-toggle" />
                <span>Dark</span>
            </label>
        </div>
    </header>
    <main class="container px-4 mx-auto">
        <div class="flex p-4 gap-4">
            <!-- Form -->
            <form action="add.php" method="post" id="userForm" class="form-control w-1/3 mx-auto">
                <div class="text-center text-2xl font-semibold">Form</div>

                <!-- Hidden input for ID -->
                <input type="hidden" name="id" id="userId" />

                <label class="label">
                    <span class="label-text">Name</span>
                </label>
                <input type="text" class="input input-bordered" name="name" id="name" placeholder="ชื่อ" />

                <label class="label">
                    <span class="label-text">Telephone number</span>
                </label>
                <input type="text" class="input input-bordered" name="tel" id="tel" placeholder="หมายเลขโทรศัพท์"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" />

                <div class="flex gap-2">

                    <button type="submit" class="btn btn-primary mt-4 w-1/2" id="submitButton">Save</button>
                    <button type="button" class="btn btn-info mt-4 w-1/2" onclick="location.reload()">Cancel</button>
                </div>
            </form>

            <!-- Table with DataTables -->
            <div class="w-2/3">
                <div class="border border-warning rounded-lg shadow-md p-4">
                    <table id="datatable" class="cell-border order-column w-full">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Telephone Number</th>
                                <th data-dt-order="disable">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM users";
                            $result = mysqli_query($conn, $sql);
                            foreach ($result as $row) { ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['tel']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning editBtn" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-tel="<?php echo $row['tel']; ?>">Edit</button> |
                                        <a href="del.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-error" onclick="return confirmDelete();">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
           const confirmDelete = () => {
       return confirm("Are you sure you want to delete this data?");
   }
        document.getElementById('theme-toggle').addEventListener('change', (e) => {
            document.documentElement.setAttribute('data-theme', e.target.checked ? 'dark' : 'light');
        });
        new DataTable('#datatable', {
            layout: {
                bottomEnd: {
                    paging: {
                        firstLast: false
                    }
                }
            },
            columnDefs: [{
                "className": "dt-center",
                "targets": "_all"
            }, {
                "searchable": false,
                "targets": 2
            }]
        });
        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('userId').value = button.getAttribute('data-id');
                document.getElementById('name').value = button.getAttribute('data-name');
                document.getElementById('tel').value = button.getAttribute('data-tel');
                document.getElementById('submitButton').innerText = 'Update';
                document.getElementById('userForm').action = 'edit.php';
            });
        });
    </script>
</body>

</html>