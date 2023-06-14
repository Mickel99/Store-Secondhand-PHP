<div class="add-clothes-form-container">
    <h2>Add Clothes</h2>
    <form action="index.php?action=add_clothes" method="POST">
        <label for="clothing">Clothing:</label>
        <input type="text" id="clothing" name="clothing" required>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required>
        <label for="seller_id">Seller:</label>
        <select id="seller_id" name="seller_id" required>
            <option value="">Select Seller</option>
            <?php foreach ($sellers as $seller) : ?>
                <option value="<?= $seller['id'] ?>"><?= $seller['first_name'] ?> <?= $seller['last_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Add Clothes">
    </form>
</div>
