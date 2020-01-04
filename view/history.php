<section class="customer-cars">
  <header class="customer-cars__header">История сервиса</header>
  <select class="customers-history__documents-list">
    <option value="all" class="customers-history__documents-list-item">Все документы</option>
    <?php foreach($cars as $car): ?>
      <option value="<?= $car->car_id ?>" class="customers-history__documents-list-item"><?= $car->model ?></option>
    <?php endforeach; ?>
  </select>
  <h2 class="customer-history__car-name-header"><?= $currentDocument ?></h2>
  <table class="customer-cars__table">
    <thead class="customer-cars__table-thead">
    <tr class="customer-cars__table-thead-tr">
      <th class="customer-cars__table-th">Номер документа</th>
      <th class="customer-cars__table-th">Статус</th>
      <th class="customer-cars__table-th">Дата</th>
      <th class="customer-cars__table-th">Подробнее</th>
    </tr>
    </thead>
    <tbody class="customer-cars__table-tbody">
    <?php foreach($documents as $k => $document): ?>
      <tr data-document-id="<?= $document->document_id ?>" class="customer-cars__table-tbody-tr <?php if ($k % 2 === 1) echo 'customer-cars__table-tbody-tr--grey'?>">
        <td class="customer-cars__table-td"><?= $document->document_id ?></td>
        <td class="customer-cars__table-td"><?= $document->status ?></td>
        <td class="customer-cars__table-td"><?= $document->date ?></td>
        <td class="customer-cars__table-td">>>></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</section>

<template class="hidden customers-history__table-template">
  <tbody class="customer-cars__table-tbody">
  <tr class="customer-cars__table-tbody-tr" data-document-id="id">
    <td class="customer-cars__table-td"></td>
  </tr>
  </tbody>
</template>
<template class="hidden customers-history__works-template">
  <tr class="customers-history__work-tr">
    <td class="customers-history__work-td" colspan="4"></td>
  </tr>
  <section class="customer-cars__works">
    <div class="customer-cars__work-item"></div>
  </section>
</template>

<div class="wait-screen hidden preloader-mini">
  <div class="preloader-mini__item">
    <div class="preloader-mini__item-tool"></div>
    <div class="preloader-mini__item-tool"></div>
    <div class="preloader-mini__item-tool"></div>
    <div class="preloader-mini__item-tool"></div>
  </div>
</div>

<script src="/customer/assets/js/helpers.js"></script>
<script src="/customer/assets/js/history.js"></script>