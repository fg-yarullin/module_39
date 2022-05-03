<h2>User List</h2>
<table>
    <thead>
        <th>Имя</th>
        <th>Email</th>
        <th>Роль</th>
        <th>Права</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td class="text-left"><?= $user->name; ?></td>
                <td><?= $user->email; ?></td>
                <td><?= $user->role; ?></td>
                <td><?= $user->permissions; ?></td>
                <td>
                    <a href="/user/permissions?id=<?= $user->id; ?>">Изменит права</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
