<div class="panel panel-default">
    <div class="datatable-pagination">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User Group</th>
                    <th>Module</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $limit = intval(isset($this->params['named']['limit']) ? $this->params['named']['limit'] : 10);
                $page = intval(isset($this->params['named']['page']) ? $this->params['named']['page'] : 1);
                $i = ($limit * $page) - ($limit - 1);
                foreach ($data['rows'] as $item) {
                    ?>
                    <tr id="row-<?= $i ?>">
                        <td><?= $i ?></td>
                        <td><a href="<?= Router::url("/admin/roles/edit/{$item['UserGroup']['id']}") ?>"><?php echo $item['UserGroup']['name']; ?></a></td>
                        <td>
                            <?php
                            foreach ($item['Role'] as $role) {
                                echo "<li>" . $role['Module']['name'] . "</li>";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php echo $this->element(_TEMPLATE_DIR . "/{$template}/pagination") ?>
