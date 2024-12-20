<div class="main-container">

    <form class="box login " action="" method="POST" autocomplete="off" >
		<h5 class="title is-5 has-text-centered is-uppercase"></h5>
        <div class="logoAcema">

            <img class ="image"src="https://erp-acema.com/images/Logo-acema-sin%20fondo.png"  width="112" height="28">
        </div>
        

		<div class="field">
			<label class="label">Usuario</label>
			<div class="control">
			    <input class="input" type="text" name="login_usuario"  maxlength="100" required >
			</div>
		</div>

		<div class="field">
		  	<label class="label">Clave</label>
		  	<div class="control">
		    	<input class="input" type="password" name="login_clave"  maxlength="100" required >
		  	</div>
		</div>

		<p class="has-text-centered mb-4 mt-3">
			<button type="submit" class="button is-info is-rounded">Iniciar sesion</button>
		</p>

	</form>
</div>

<?php
	
	

	if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
		$insLogin->iniciarSesionControlador();
	}

	
?>


<style>
	.box {
    border-radius: 10px;
	padding: 20px;
    max-width: 400px;
    margin: 0 auto;
    background-color: white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
	}

	.main-container{
		background-color: #c2cfd0;
		display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        padding: 10px;
	}

	.logoAcema{
		display: flex;
		justify-content: center;
		margin-bottom: 20px;
		height: 50px;
  		width: 100%;
	}
	
	button.button.is-info.is-rounded:hover{
		background-color: green ;
	}

	    /* Media Queries */
		@media (max-width: 768px) {
        .box {
            padding: 15px;
            max-width: 90%;
        }
    }

    @media (max-width: 480px) {
        .box {
            padding: 10px;
            max-width: 95%;
        }

        .title {
            font-size: 1.2rem;
        }

        .input {
            font-size: 0.9rem;
        }
    }
    /* Media Queries */
	@media (max-width: 768px) {
        .box {
            padding: 15px;
            max-width: 90%;
        }

        .logoAcema img {
            width: 80px;
            height: auto;
        }
    }

    @media (max-width: 480px) {
        .box {
            padding: 10px;
            max-width: 95%;
        }

        .title {
            font-size: 1.2rem;
        }

        .input {
            font-size: 0.9rem;
        }

        .logoAcema img {
            width: 60px;
            height: auto;
        }

        .button {
            font-size: 0.9rem;
            padding: 8px 15px;
        }
    }

</style>

