<?php $pager->setSurroundCount(2); ?>
<nav>
    <ul class="pagination">
        <?php if ($pager->hasPrevious()) { ?>
            <li class="page-item">
                 <a href="<?= $pager->getFirst() ?>" aria-label="First" class="page-link pb-2 pt-2">
                    <span aria-hidden="true">First</span>
                </a>
            </li>
            <li class="page-item">
                <a href="<?= $pager->getPrevious() ?>" class="page-link pb-2 pt-2" aria-label="Previous">
                    <span>&laquo;</span>
                </a>
            </li>
        <?php } ?>

        <?php 
            foreach ($pager->links() as $link) { 
                $activeclass = $link['active']?'active':'';
        ?>
            <li class="page-item <?= $activeclass ?>">
                <a href="<?= $link['uri'] ?>" class="page-link pb-2 pt-2">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php } ?>

        <?php if ($pager->hasNext()) { ?>
            <li class="page-item">
                <a href="<?= $pager->getNext() ?>" aria-label="Next" class="page-link pb-2 pt-2">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            <li class="page-item">
                 <a href="<?= $pager->getLast() ?>" aria-label="Last" class="page-link pb-2 pt-2">
                    <span aria-hidden="true">Last</span>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>