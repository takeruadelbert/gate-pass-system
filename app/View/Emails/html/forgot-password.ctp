Hi,<?= $username?><br/><br/>

Anda melakukan permintaan reset password.<br/>
Klik link <a href="<?= Router::url("/reset-password/{$token}",true) ?>">disini</a> untuk mereset password anda.<br/>
Link hanya berlaku 24jam.
