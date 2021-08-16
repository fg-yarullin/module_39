<?php extract($data);?>

<div class="store_view">
<h1><?=$title?></h1>
<p>
    <?php if(empty($cart)): ?>
        Your Cart is empty! Please, go <a href="/store">back to Store</a> and select products you want.
    <?php else:?>
        <form action="/order" method="POST">

        <table class="table table-striped w-75">
        <thead>
            <tr>
                <th>#</th>
                <th>Product name</th>
                <th>Price</th>
                <th>In Stock</th>
                <th>Set Quantity</th>
            </tr>
        </thead>
            <tbody>
                <?php foreach($productData as $key => $product): ?>
                    <tr>
                        <td><?=$key +1 ?></td>
                        <td><?=$product['name']?></td>
                        <td class="text-right"><?=$product['price']?></td>
                        <td class="text-center"><?=$product['quantity']?></td>
                        <td class="text-center">
                            <input class="text-center ml-2" style="width:50px" 
                                type="number" min="0" name="parts[<?=$key?>]" value="1">
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="delivery">
        <label for="<?='type1'?>">Select the type of delivery:</label>
        <?php foreach ($delivery["type"] as $key => $type): ?>
            <p>
                <input type="radio" name="delivery" id="<?=$key?>" value="<?=$type?>" <?php echo ($key==='type-1')?'checked="checked"':'' ?>>
                <label for="type_<?=$type ?>"><?=$type ?></label>
            </p>
        <?php endforeach ?>
        
        <p>
            <p class="text-muted pl-3">The required data will be taken from your profile</p>
            <label for="email">Enter your login (email) <?=$email ?? null ?></label>       
            <input type="email" name="email" id="email" required value="<?=$_POST['email'] ?? null?>">
        </p>
        </div>

        <input class="btn btn-outline-secondary" type="submit" value="Form an Order">

        </form>        
    <?php endif?>
</p>
</div>