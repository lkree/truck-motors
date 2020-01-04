<section class="customer-cars">
  <header class="customer-cars__header">Мой гараж</header>
  <table class="customer-cars__table">
    <thead class="customer-cars__table-thead">
    <tr class="customer-cars__table-thead-tr">
      <th class="customer-cars__table-th">Модель</th>
      <th class="customer-cars__table-th">VIN</th>
      <th class="customer-cars__table-th">Пробег</th>
      <th class="customer-cars__table-th">Номер</th>
    </tr>
    </thead>
    <tbody class="customer-cars__table-tbody">
    <?php foreach($cars as $car): ?>
      <tr class="customer-cars__table-tbody-tr">
        <td class="customer-cars__table-td"><a class="customer-cars__table-link" href="/customer/history.html?ci=<?= $car->car_id ?>"><?= $car->model ?></a></td>
        <td class="customer-cars__table-td"><a class="customer-cars__table-link" href="/customer/history.html?ci=<?= $car->car_id ?>"><?= $car->vin ?></a></td>
        <td class="customer-cars__table-td"><a class="customer-cars__table-link" href="/customer/history.html?ci=<?= $car->car_id ?>"><?= $car->mileage ?></a></td>
        <td class="customer-cars__table-td"><a class="customer-cars__table-link" href="/customer/history.html?ci=<?= $car->car_id ?>"><?= $car->plate ?></a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</section>