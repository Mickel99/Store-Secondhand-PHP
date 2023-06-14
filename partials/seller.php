<div class="seller-container">
    <h2><?= $seller['first_name'] ?> <?= $seller['last_name'] ?></h2>
    <div class="clothes-container">
        <h3>Clothes</h3>
        <table class="table-container">
            <tr>
                <th>Clothing</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php foreach ($clothes as $clothing) : ?>
                <tr>
                    <td><?= $clothing['clothing'] ?></td>
                    <td><?= $clothing['price'] ?></td>
                    <td><?= $clothing['sold'] ? 'Sold' : 'Available' ?></td>
                    <?php if (!$clothing['sold']) : ?>
                        <td>
                            <form action="index.php?action=buy_clothes" method="POST">
                                <input type="hidden" name="clothing_id" value="<?= $clothing['id'] ?>">
                                <input type="submit" value="Buy">
                            </form>
                        </td>
                    <?php else : ?>
                        <td></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php $totalSales = $model->getTotalSalesBySellerId($sellerId); ?>
    <p>Total Sales: <?= $totalSales ?></p>
    <?php $numberOfSoldClothes = $model->getNumberOfSoldClothesBySellerId($sellerId); ?>
    <p>Number of Sold Clothes: <?= $numberOfSoldClothes ?></p>
</div>
