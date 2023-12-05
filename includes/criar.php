<?php
include('../auth/protect.php');
include 'index.php';
?>
<h1>
Novo Funcionário
</h1>
<?php
 include "../templates/estilo.html";
?>

<form action="processo-de-criacao.php" method="post" class="row g-3 needs-validation" style="margin-left: 15px;"required>
  <input type="hidden" name="operacao" value="criacao">
  <div class="col-md-4">
    <label for="validationCustom01" class="form-label">Nome completo</label>
    <input type="text" name="nome" class="form-control" id="validationCustom01" required>
    <div class="valid-feedback">
      parece bom
    </div>
  </div>
  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">E-mail</label>
    <input type="email" name='email' class="form-control" id="validationCustom02" required>
    <div class="valid-feedback">
      validado
    </div>
  </div>
  <div class="col-md-4">
    <label for="validationCustomUsername" class="form-label">Senha</label>
    <div class="input-group has-validation">
      <input type="password" name='senha' class="form-control" id="validationCustomUsername"required>
      <div class="invalid-feedback">
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <label for="validationCustomUsername" class="form-label">Data de Nascimento</label>
    <div class="input-group has-validation">
      <input type="date" name='data_nasc' class="form-control" id="validationCustomUsername" required>
      <div class="invalid-feedback">
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <label for="validationCustom03" class="form-label">Cargo</label>
    <input type="text" name="cargo" class="form-control" id="validationCustom03" required>
    <div class="invalid-feedback">
    </div>
  </div>

  <div style="margin-top: 20px ; "class="mb-3">
  <label for="validationCustom03" class="form-label">Ficha técnica</label>
  <input type="file" name="ficha" accept=".pdf" required>
    <div class="invalid-feedback">Formato inválido</div>
  </div>
    
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Me responsabilizo em caso de inserção de dados incorretos
      </label>
      <div class="invalid-feedback">
        Você deve aceitar os termos de resonsabilidade
      </div>
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Cadastrar</button>
  </div>
</form>