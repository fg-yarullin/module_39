<?php extract($data);?>

<div class="store_view">
<h1><?=$title?></h1>
<p>
    <?php if(empty($address)): ?>
    <div class="alet alert-danger p-2">
    <span> Your have to register an Acount and set your profile.</span>
    </div>
    <?php else: ?>

        <table class="table table-striped w-75">
        <thead>
            <tr>
                <th>#</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Parts</th>
                <th>Total Price</th>
            </tr>
        </thead>
            <tbody>
                <?php $sum = 0; foreach($productData as $key => $product): ?>
                <?php $sum += $parts[$key] * $product['price'] ?>
                    <tr>
                        <td><?=$key + 1?></td>
                        <td class="text-right"><?=$product['name']?></td>
                        <td class="text-center"><?=$product['price']?></td>
                        <td><?=$parts[$key]?></td>
                        <td><?=$parts[$key] * $product['price'] ?></td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td collspan="5"><?=$sum?></td>
                </tr>
            </tbody>
        </table>
        
        <p>Deliver type: <?=$delivery ?? null?></p>

        <p>Delivery address: <?=$address ?? null?></p>

        <p>You have to pay: <?=$sum?></p>

    <?php endif?>
</p>
</div>