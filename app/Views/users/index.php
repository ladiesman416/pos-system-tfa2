   <?= $this->extend('layout') ?>
   <?= $this->section('content') ?>
   <h1>User Accounts</h1>
   <table border="1" cellpadding="6">
           <tr><th>Username</th><th>Full Name</th></tr>
       <?php foreach ($users as $u): ?>
           <tr>
               <td><?= esc($u['username']) ?></td>
               <td><?= esc($u['full_name']) ?></td>
               
           </tr>
       <?php endforeach; ?>
   </table>
   <?= $this->endSection() ?>