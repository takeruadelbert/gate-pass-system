<?php echo $this->Form->create("LoginPage", array("class" => "form-horizontal form-separate", "action" => "edit", "id" => "formSubmit", "inputDefaults" => array("error" => array("attributes" => array("wrap" => "label", "class" => "error"))))) ?>
<div class="row">
    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <h6 class="heading-hr"><?= __("Ubah Akses Login") ?>
                    </h6>
                </div>
                <div class="table-responsive">
                    <table width="100%" class="table">
                        <tr>
                            <td colspan="3" style="width:200px">
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->label("LoginPage.label", __("Halaman Login"), array("class" => "col-sm-3 col-md-4 control-label"));
                                    echo $this->Form->input("LoginPage.label", array("div" => array("class" => "col-sm-9 col-md-8"), "label" => false, "class" => "form-control", "disabled" => true));
                                    ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                $i = 0;
                                $current = [];
                                foreach ($this->data['LoginPageCredential'] as $lpc) {
                                    $current[$lpc['UserGroup']['id']] = [
                                        "access" => $lpc['access'],
                                        "id" => $lpc['id'],
                                    ];
                                }
                                foreach ($dataUserGroup as $item) {
                                    $i++;
                                    if (array_key_exists($item['UserGroup']['id'], $current) && $current[$item['UserGroup']['id']]['access']) {
                                        $accessible = 'checked';
                                        $accessibleDisabled = "disabled";
                                    } else {
                                        $accessible = null;
                                        $accessibleDisabled = null;
                                    }
                                    if (array_key_exists($item['UserGroup']['id'], $current)) {
                                        ?>
                                        <input type="hidden" name="data[LoginPageCredential][<?= $i ?>][id]" value="<?= $current[$item['UserGroup']['id']]['id'] ?>"/>
                                        <?php
                                    }
                                    ?>
                                    <input type="hidden" name="data[LoginPageCredential][<?= $i ?>][user_group_id]" value="<?= $item['UserGroup']['id']?>"/>
                                    <label class="checkbox-inline checkbox-success toggledisabled">
                                        <input type="checkbox" class="styled togglecon" name="data[LoginPageCredential][<?= $i ?>][access]" value="1" <?php echo $accessible; ?>>
                                        <input type="hidden" name="data[LoginPageCredential][<?= $i ?>][access]" value="0" <?php echo $accessibleDisabled; ?>/>
                                        <?= $item['UserGroup']['label'] ?>
                                    </label>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="block-inner text-danger">
                    <div class="form-actions text-center">
                        <input name="Button" type="button" onclick="history.go(-1);" class="btn btn-success" value="<?= __("Kembali") ?>">
                        <input type="reset" value="Reset" class="btn btn-info">
                        <input type="submit" value="<?= __("Simpan") ?>" class="btn btn-danger">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end() ?>
<script>
    $(document).ready(function () {
        $(".toggledisabled").on("click", function () {
            if ($(this).find(".togglecon").is(':checked')) {
                $(this).find("input[type=hidden]").attr("disabled", "disabled");
            } else {
                $(this).find("input[type=hidden]").removeAttr("disabled");
            }
        })
    })
</script>