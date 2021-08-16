<?php $title = 'Store'?>

<div class="store_view">
<h1><?=$title?></h1>
<p>
<form action="/cart" method="POST">

    <table class="table table-striped w-75">
    <thead>
        <tr>
            <th>Product name</th>
            <th>description</th>
            <th>Price</th>
            <th>Available<br>quantity</th>
            <th>Select</th>
        </tr>
    </thead>
        <tbody>
            <?php foreach($data as $key => $row): ?> 
                <tr>
                    <td><?=$row['name']?></td>
                    <td><?=$row['description']?></td>
                    <td class="text-right"><?=$row['price']?></td>
                    <td class="text-center"><?=$row['quantity']?></td>
                    <td class="text-center">
                        <?php if ($row['quantity']):?>
                            <input type="checkbox" name="cart[]" value="<?=$key?>" <?php if(isset($_SESSION['cart']) && in_array($key, $_SESSION['cart'])) echo 'checked="checked"'; ?>>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <input class="btn btn-outline-secondary" type="submit" value="Add to Cart">

</form>
</p>
</div>