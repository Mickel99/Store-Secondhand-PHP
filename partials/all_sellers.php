<div class="all-sellers-container">
    <h2>All Sellers</h2>
    <table class="table-container">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($sellers as $seller) : ?>
            <tr>
                <td><?= $seller['first_name'] ?></td>
                <td><?= $seller['last_name'] ?></td>
                <td><a href="index.php?action=seller&id=<?= $seller['id'] ?>">View</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
