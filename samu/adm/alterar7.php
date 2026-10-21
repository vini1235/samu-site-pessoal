<?php
require_once __DIR__ . '/../usuarios_helpers.php';
samu_users_require_role(1);
require_once __DIR__ . '/../conexao/conexao.php';
$id = filter_var($_POST['id'] ?? $_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if (!$id) {
    samu_users_error(422, 'Usuário inválido.');
}
$statement = $conn->prepare('SELECT id, nome, email, niveis_acesso_id FROM usuarios WHERE id = ?');
$statement->bind_param('i', $id);
$statement->execute();
$account = $statement->get_result()->fetch_assoc();
if (!$account) {
    samu_users_error(404, 'Usuário não encontrado.');
}
header('Content-Type: text/html; charset=utf-8');
?>
<div class="modal-content">
    <div class="modal-header">
        <h2 class="modal-title fs-5">Editar usuário</h2>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
    </div>
    <form method="POST" action="cruid7.php?id=<?php echo (int) $account['id']; ?>&amp;acao=atualizar">
        <div class="modal-body">
            <div class="mb-3">
                <label for="edit-user-name">Nome</label>
                <input class="form-control" type="text" name="nome" id="edit-user-name" maxlength="220" required value="<?php echo samu_users_escape($account['nome']); ?>">
            </div>
            <div class="mb-3">
                <label for="edit-user-email">E-mail</label>
                <input class="form-control" type="email" name="email" id="edit-user-email" maxlength="220" required value="<?php echo samu_users_escape($account['email']); ?>">
            </div>
            <div class="mb-3">
                <label for="edit-user-password">Nova senha</label>
                <input class="form-control" type="password" name="senha" id="edit-user-password" maxlength="220" autocomplete="new-password" aria-describedby="edit-user-password-help">
                <p class="form-text" id="edit-user-password-help">Deixe em branco para manter a senha atual.</p>
            </div>
            <div class="mb-3">
                <label for="edit-user-role">Nível de acesso</label>
                <select class="form-control" name="niveis_acesso_id" id="edit-user-role" required>
                    <option value="1"<?php echo (string) $account['niveis_acesso_id'] === '1' ? ' selected' : ''; ?>>Administrador</option>
                    <option value="2"<?php echo (string) $account['niveis_acesso_id'] === '2' ? ' selected' : ''; ?>>Usuário</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
        </div>
    </form>
</div>
