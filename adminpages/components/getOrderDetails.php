<!-- ... (โค้ดที่ไม่เปลี่ยนแปลง) ... -->
<?php

function getOrderItems($orderId)
{
    global $pdo;

    $sql = "SELECT product.p_name, order_items.quantity FROM order_items
            JOIN product ON order_items.p_id = product.p_id
            WHERE ord_id = :orderId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<td colspan="6">
    <div id="details_<?php echo $order['ord_id']; ?>">
        <p>Details for Order <?php echo $order['ord_id']; ?>:</p>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <!-- เพิ่มคอลัมน์อื่น ๆ ตามต้องการ -->
                </tr>
            </thead>
            <tbody>
                <?php
                $ordId = $order['ord_id'];
                $orderItems = getOrderItems($ordId); // ฟังก์ชันที่คืนข้อมูล order_items ของคำสั่งซื้อที่ระบุ
                foreach ($orderItems as $item) :
                ?>
                    <tr>
                        <td><?php echo $item['p_name']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <!-- เพิ่มคอลัมน์อื่น ๆ ตามต้องการ -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</td>

<!-- ... (โค้ดที่ไม่เปลี่ยนแปลง) ... -->
