<h2>User List</h2>
<table>
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Edit</th>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td class="text-left"><?= $user->name; ?></td>
                <td><?= $user->email; ?></td>
                <td>
                    <a href="/user/permissions?id=<?= $user->id; ?>">Edit Permissions</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
