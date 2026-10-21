<?php
if (!isset($samuRole) || !in_array($samuRole, [1, 2], true)) {
    http_response_code(404);
    exit;
}
require_once __DIR__ . '/usuarios_helpers.php';
samu_users_require_role(1);
require __DIR__ . '/conexao/conexao.php';
require_once __DIR__ . '/layout.php';
$result = $conn->query('SELECT id, nome, email, niveis_acesso_id FROM usuarios ORDER BY id DESC');
samuPageStart('Usuários', 'Gerencie os acessos ao sistema SAMU.', '', 'usuario.php');
?>
<section class="panel-samu">
<div class="d-flex flex-wrap gap-3 align-items-center justify-content-between mb-4"><div><h2 class="h5 mb-1">Usuários cadastrados</h2><p class="text-muted mb-0"><?= $result->num_rows ?> usuários</p></div><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModalcad">Cadastrar usuário</button></div>
<label class="form-label" for="user-search">Buscar por nome ou e-mail</label><input type="search" class="form-control mb-4" id="user-search" placeholder="Digite para buscar…">
<div class="table-responsive"><table class="table table-hover" id="employee_data"><thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Perfil</th><th>Ações</th></tr></thead><tbody>
<?php while ($row=$result->fetch_assoc()): ?><tr><td><?= (int)$row['id'] ?></td><td><?= samu_users_escape($row['nome']) ?></td><td><?= samu_users_escape($row['email']) ?></td><td><span class="badge text-bg-light"><?= (int)$row['niveis_acesso_id']===1?'Administrador':'Usuário' ?></span></td><td><div class="d-flex gap-2"><button type="button" class="btn btn-outline-secondary btn-sm edit-user" data-id="<?= (int)$row['id'] ?>">Editar</button><a class="btn btn-outline-danger btn-sm" href="delete7.php?cod=<?= (int)$row['id'] ?>" onclick="return confirm('Excluir este usuário?')">Excluir</a></div></td></tr><?php endwhile; ?>
</tbody></table><p id="no-users" class="text-muted text-center py-3" hidden>Nenhum usuário encontrado.</p></div></section>
<div class="modal fade" id="myModalcad" tabindex="-1" aria-labelledby="create-user-title" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h2 class="modal-title fs-5" id="create-user-title">Cadastrar usuário</h2><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button></div>
<form action="cadastrar.php" method="post" id="form"><div class="modal-body">
<div class="mb-3"><label class="form-label" for="nome">Nome</label><input class="form-control" name="nome" id="nome" maxlength="220" required autocomplete="name"></div>
<div class="mb-3"><label class="form-label" for="email">E-mail</label><input type="email" class="form-control" name="email" id="email" maxlength="220" required autocomplete="email"></div>
<div class="mb-3"><label class="form-label" for="senha">Senha</label><input type="password" class="form-control" name="senha" id="senha" maxlength="220" required autocomplete="new-password"></div>
<div class="mb-3"><label class="form-label" for="niveis_acesso_id">Perfil</label><select class="form-select" name="niveis_acesso_id" id="niveis_acesso_id"><option value="2">Usuário</option><option value="1">Administrador</option></select></div>
</div><div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button><button class="btn btn-primary" type="submit">Cadastrar</button></div></form></div></div></div>
<div class="modal fade" id="myModal" tabindex="-1" aria-label="Editar usuário" aria-hidden="true"><div class="modal-dialog"><div id="content-data"></div></div></div>
<?php samuPageEnd(); ?>
<script>
document.getElementById('user-search').addEventListener('input', function(){let count=0; document.querySelectorAll('#employee_data tbody tr').forEach(row=>{row.hidden=!row.textContent.toLocaleLowerCase().includes(this.value.toLocaleLowerCase());if(!row.hidden)count++;});document.getElementById('no-users').hidden=count>0;});
document.querySelectorAll('.edit-user').forEach(button=>button.addEventListener('click',async()=>{button.disabled=true;try{const response=await fetch('alterar7.php',{method:'POST',body:new URLSearchParams({id:button.dataset.id})});if(!response.ok)throw new Error();document.getElementById('content-data').innerHTML=await response.text();bootstrap.Modal.getOrCreateInstance(document.getElementById('myModal')).show();}catch(error){alert('Não foi possível abrir a edição. Tente novamente.');}finally{button.disabled=false;}}));
</script></body></html>
