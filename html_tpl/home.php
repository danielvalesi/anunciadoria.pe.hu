<!-- Middle -->
<section class="back-v pd" id="_video">
	<div class="container_grid max1200 responsive marg7">
    	
      <div class="grid_12 last txtcenter">
        	<p class="frase-video">Simples, rápido e direto!</p>
      </div>
        
        <div class="grid_12 last video">
           	<iframe class="video-player" src="https://www.youtube.com/embed/clYMYliLFlk?rel=0" frameborder="0" allowfullscreen></iframe> 
        </div>
        
        <div class="grid_12 last txtcenter marg11">
             <a href="" data-scid="_cadastro" class="btn-experiencia vermelho2 marg2 dinline-block vtop" title="Iniciar experiência"<?php if($c->user) { ?> style="display:none;"<?php } ?>>Iniciar experiência</a>
        </div>
        
        <div class="clear"></div>
    </div>
</section>

<section class="pd" id="_contato">
	<div class="container_grid max1200 responsive marg7">
    	
        <div class="grid_12 last txtcenter">
			<a class="logo dinline-block" title="Anunciadoria" href="">
				<img class="responsive marg" src="img/anunciadoria-logo.jpg" alt="Anunciadoria">
			</a>
		</div>
        
        <div class="grid_12 last txtcenter marg">
			<h5>Contato, sugestões ou críticas</h5>
            <p>Precisando entrar em contato estaremos sempre dispostos a atende-lo, compartilhe conosco<br>sua sugestão ou crítica para que possamos sempre melhor atende-lo.</p>
		</div>
        
        <div class="grid_12 last marg">
       	  <div class="row responsive">
            <div class="form-contato grid_12 last adapt" id="contato-box">
				<input type="hidden" id="contato-tipo" value="Contato Home">
                <div class="grid_8">
                	<span class="lineform smallControl">
					<input type="text" id="contato-nome" placeholder="Nome">
					</span>
                </div>
                <div class="grid_4 last">
                	<span class="lineform smallControl">
					<input type="text" id="contato-email" placeholder="Email">
					</span>
                </div>
                <div class="grid_4">
                	<span class="lineform smallControl">
					<input type="text" id="contato-telefone" placeholder="Telefone">
					</span>
                </div>
                <div class="grid_8 last">
                	<span class="lineform smallControl">
					<div class="selecao">
                    <span>Assunto</span>
                    <select id="contato-assunto">
					  <option class="cor" value="">Assunto</option>
                      <option class="cor" value="Anúncio">Anúncio</option>
					  <option class="cor" value="Cadastro/Conta">Cadastro/Conta</option>
					  <option class="cor" value="Problemas com a Plataforma">Problemas com a Plataforma</option>
					  <option class="cor" value="Denúncia">Denúncia</option>
					  <option class="cor" value="Sugestão/Reclamação">Sugestão/Reclamação</option>
					  <option class="cor" value="Imprensa">Imprensa</option>
					  <option class="cor" value="Outro (personalizável)">Outro (personalizável)</option>
					</select>
                    </div>
					</span>
                 </div>
                 <div class="grid_12 last">
                 	<span class="lineform smallControl">
					<textarea id="contato-msg" placeholder="Mensagem"></textarea>
					</span>
                 </div>
                 <div class="grid_12 last txtcenter">
                 	<button class="btn-einfo cinza dblock" title="Enviar Informações" id="contato-enviar">Enviar informações</button>
                    <span class="btn-einfo cinza-claro dblock dnone" id="contato-loading">Enviando...</span>
                    <span class="btn-einfo verde dblock dnone" id="contato-ok">Enviado com sucesso !</span>
                 </div>
            </div>
                <div class="clear"></div>
            </div>
        </div>
        
    </div>
</section>
<!-- End. Middle -->