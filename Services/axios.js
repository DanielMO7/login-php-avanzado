
/**
 * Validacion de las credenciales del usuario.
 */
    

function ingresarSistema(){
        let formulario = document.forms['formulario-script'];
        let email = formulario['email'].value;
        let contrasena = formulario['contrasena'].value;
        let credenciales = new FormData();
        credenciales.append('email', email);
        credenciales.append('contrasena', contrasena);

        /*console.log(credenciales);*/

       axios.post('http://localhost:81/login/index.php/login/loguearse',
       credenciales

    )
    .then(function (response){
        if(response.data == 1){
            window.location.replace("http://localhost:81/login/index.php/home");
        }else if(response.data == 2){
            let mensaje = document.getElementById('mensaje-error');
            mensaje.classList.add('activar');
            mensaje.classList.remove('activo');
            console.log('Contraseña incorrecta.')

        }
        console.log(response.data);
    })
    .catch(function(error){
        console.log(error);
    })
}


/**
 * Validacion de credenciales para registro de usuario.
 */
function registrarUsuario(){
        let formulario = document.forms['formulario-script'];
    
        let nombre = formulario['nombre'].value;
        let documento = formulario['documento'].value;
        let email = formulario['email'].value;
        let contrasena = formulario['contrasena'].value;
        let rol = formulario['rol'].value;

        let credenciales = new FormData();
        credenciales.append('nombre', nombre);
        credenciales.append('documento', documento);
        credenciales.append('email', email);
        credenciales.append('contrasena', contrasena);
        credenciales.append('rol', rol);
        
        //console.log(credenciales.get('nombre'));

        axios.post('http://localhost:81/login/index.php/register/insertar',
        credenciales
        )
        .then(function (response){
            if(response.data == 1){
                let mensaje = document.getElementById('mensaje-ok');
                mensaje.classList.add('activar');

            }else if(response.data == 2){
                let mensaje = document.getElementById('mensaje-error');
                mensaje.classList.add('activar');
                mensaje.classList.remove('acivar');
                console.log('Contraseña incorrecta.')
    
            }
            console.log(response.data);
        })
        .catch(function(error){
            console.log(error);
        })
}


