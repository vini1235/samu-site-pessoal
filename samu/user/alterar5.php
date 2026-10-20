<?php
require_once __DIR__ . '/../conexao/occurrences.php';
$linha = samuLoadOccurrence('psiquiatria', 2);
$id = (int) $linha['id'];
header('Content-Type: text/html; charset=utf-8');
?>
<div class="modal-header">
    <h5 class="modal-title" id="edit-modal-title"><i class="bi bi-pencil-square" aria-hidden="true"></i> Editar ocorrência — Psiquiatria</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
</div>
<div class="modal-body">
    <form method="POST" id="occurrence-edit-form" action="cruid5.php?id=<?php echo $id; ?>&acao=atualizar">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="edit-txtdatahora" class="form-label">Data/Hora</label>
                <input type="text" class="form-control" name="txtdatahora" id="edit-txtdatahora" value="<?php echo samuOccurrenceEscape($linha ["txtdatahora"]); ?>" maxlength="19" size="19" placeholder="dd/mm/aaaa hh:mm:ss" required="required">
            </div>
            <div class="col-md-6">
                <label for="edit-funcionario" class="form-label">Funcionário</label>
                <input type="text" class="form-control" name="funcionario" id="edit-funcionario" value="<?php echo samuOccurrenceEscape($linha ["funcionario"]); ?>" placeholder="Digite o nome do funcionário" required="required">
            </div>
            <div class="col-md-6">
                <label for="edit-plantao" class="form-label">Plantão</label>
                <input type="text" class="form-control" name="plantao" id="edit-plantao" value="<?php echo samuOccurrenceEscape($linha ["plantao"]); ?>" placeholder="Digite o plantão" required="required">
            </div>
            <div class="col-md-6">
                <label for="edit-ocorrencia" class="form-label">Ocorrência</label>
                <select class="form-select" name="ocorrencia" id="edit-ocorrencia">
                    <option>PSIQUIATRIA</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="edit-evento" class="form-label">Nº do evento</label>
                <input type="text" class="form-control" name="evento" id="edit-evento" value="<?php echo samuOccurrenceEscape($linha ["evento"]); ?>" placeholder="Digite o número do evento" required="required">
            </div>
            <div class="col-md-6">
                <label for="edit-qru" class="form-label">Q.R.U</label>
                <input type="text" class="form-control" name="qru" id="edit-qru" value="<?php echo samuOccurrenceEscape($linha ["qru"]); ?>" placeholder="Digite o Q.R.U" required="required">
            </div>
            <div class="col-md-6">
                <label for="edit-qra" class="form-label">Q.R.A</label>
                <input type="text" class="form-control" name="qra" id="edit-qra" value="<?php echo samuOccurrenceEscape($linha ["qra"]); ?>" placeholder="Digite o Q.R.A" required="required">
            </div>
            <div class="col-md-6">
                <label for="edit-qth" class="form-label">Q.T.H</label>
                <input type="text" class="form-control" name="qth" id="edit-qth" value="<?php echo samuOccurrenceEscape($linha ["qth"]); ?>" placeholder="Digite o Q.T.H" required="required">
            </div>
            <div class="col-md-6">
                <label for="edit-qti" class="form-label">Q.T.I</label>
                <input type="text" class="form-control" name="qti" id="edit-qti" value="<?php echo samuOccurrenceEscape($linha ["qti"]); ?>" placeholder="Digite o Q.T.I" required="required">
            </div>
            <div class="col-12">
                <label for="edit-message" class="form-label">Observação</label>
                <textarea class="form-control" name="message" id="edit-message" rows="4" placeholder="Digite a observação" required="required"><?php echo samuOccurrenceEscape($linha ["message"]); ?></textarea>
            </div>
        </div>
        <div class="modal-footer px-0 pb-0 mt-4">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-submit w-auto" id="edit-send-message"><i class="bi bi-check-lg" aria-hidden="true"></i> Salvar alterações</button>
        </div>
    </form>
</div>
