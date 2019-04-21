<div class="tab">
    <a class="tablinks <?= $view == 'profile' ? 'active' : '' ?>" href="<?= URL ?>user/profile">Dashboard</button></a>
    <a class="tablinks <?= $view == 'orders' ? 'active' : '' ?>" href="<?= URL ?>orders">Orders</button></a>
    <a class="tablinks <?= $view == 'inventory' ? 'active' : '' ?>" href="<?= URL ?>inventory">Inventory</button></a>
    <a class="tablinks <?= $view == 'bar' ? 'active' : '' ?>" href="<?= URL ?>fitnessbar">Fitness bar</button></a>
    <a class="tablinks <?= $view == 'partners' ? 'active' : '' ?>" href="<?= URL ?>partners">Partners</button></a>
</div>