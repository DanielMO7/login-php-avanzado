/**
 *              ¡¡¡¡¡¡¡ IMPORTANTE !!!!!!!
 * Para el correcto funcionamiento del axios debes poner la url del servidor en el cual
 * esta corriendo el proyecto.
 */
let host_server = "localhost:8000";

/**
 * Validacion de las credenciales del usuario.
 */

function ingresarSistema() {
    let formulario = document.forms['formulario-script']
    let email = formulario['email'].value
    let contrasena = formulario['contrasena'].value
    let credenciales = new FormData()
    credenciales.append('email', email)
    credenciales.append('contrasena', contrasena)

    /*console.log(credenciales);*/

    axios
        .post('http://'+host_server+'/index.php/login/loguearse', credenciales)
        .then(function (response) {
            if (response.data == 1) {
                window.location.replace('http://'+host_server+'/index.php/home')
            } else if (response.data == 2) {
                let mensaje = document.getElementById('mensaje-error')
                mensaje.classList.add('activar')
                mensaje.classList.remove('activo')
                console.log('Contraseña incorrectaaaaa.')
            }
            console.log(response.data)
        })
        .catch(function (error) {
            console.log(error)
        })
}

/**
 * Validacion de credenciales para registro de usuario.
 */
function registrarUsuario() {
    let formulario = document.forms['formulario-script']

    let nombre = formulario['nombre'].value
    let documento = formulario['documento'].value
    let email = formulario['email'].value
    let contrasena = formulario['contrasena'].value
    let rol = formulario['rol'].value

    let credenciales = new FormData()
    credenciales.append('nombre', nombre)
    credenciales.append('documento', documento)
    credenciales.append('email', email)
    credenciales.append('contrasena', contrasena)
    credenciales.append('rol', rol)

    //console.log(credenciales.get('nombre'));

    axios
        .post('http://'+host_server+'/index.php/register/insertar', credenciales)
        .then(function (response) {
            if (response.data == 1) {
                window.location.replace('http://'+host_server+'/index.php/login')
                let mensaje = document.getElementById('mensaje-ok')
                alert(
                    'Te has registrado correctamente. Ahora puedes Ingresar con tus credenciales.',
                )

                /*mensaje.classList.add('activar');*/
            } else if (response.data == 2) {
                let mensaje = document.getElementById('mensaje-error')
                mensaje.classList.add('activar')
                mensaje.classList.remove('acivar')
                console.log('Contraseña incorrecta.aaaaaaa')
            }
            console.log(response.data)
        })
        .catch(function (error) {
            console.log(error)
        })
}

/**
 * Redireccion a el usuario a la vista principal
 */
function cancelarRegistro() {
    window.location.replace('http://'+host_server+'/index.php/home')
}

/**
 * Muestra los datos del usuario en la tabla
 */
function mostrarDatosUsuario() {
    const $formularios = document.getElementById('formulario-usuario-script'),
        $fragment = document.createDocumentFragment()

    async function getData() {
        try {
            let res = await axios.get(
                'http://'+host_server+'/index.php/perfil-usuario',
            ),
                json = await res.data

            //console.log(res, json);

            json.forEach((dato) => {
                const tr = document.createElement('tr')

                const td1 = document.createElement('td')
                td1.innerHTML = dato.nombre_usuario
                tr.appendChild(td1)

                const td2 = document.createElement('td')
                td2.innerHTML = dato.documento
                tr.appendChild(td2)

                const td3 = document.createElement('td')
                td3.innerHTML = dato.email
                tr.appendChild(td3)

                const td4 = document.createElement('td')
                td4.innerHTML = dato.rol
                tr.appendChild(td4)

                $fragment.appendChild(tr)
            })

            $formularios.appendChild($fragment)
        } catch (err) {
            //console.log(err.response);
            let message = err.response.statusText || 'Ocurrió un error'
            $formularios.innerHTML = `Error ${err.response.status}: ${message}`
        } finally {
            //console.log("Esto se ejecutará independientemente del try... catch");
        }
    }
    getData()
}

/**
 * Retorna la vista del perfil del usuario con el id del mismo.
 * @param {id del usuario} id
 */
function VistaEditarUsuario(id) {
    window.location.replace(
        'http://'+host_server+'/index.php/perfil-usuario?id=' + id,
    )
}

/**
 * Trae y muestra los datos del usuario
 * @param {id del usuario} id
 */
function datosUsuario(id) {
    const $formularios = document.getElementById('formulario-perfil-usuario'),
        $fragment = document.createDocumentFragment()

    async function getData() {
        try {
            let res = await axios.get(
                'http://'+host_server+'/index.php/perfil-usuario/editar_perfil?id=' +
                id,
            ),
                json = await res.data

            //console.log(json)

            json.forEach((el) => {
                document.getElementsByName('nombre_usuario')[0].value =
                    el.nombre_usuario
                document.getElementsByName('documento')[0].value = el.documento
                document.getElementsByName('email')[0].value = el.email
            })
        } catch (err) {
            //console.log(err.response);
            let message = err.response.statusText || 'Ocurrió un error'
            $formularios.innerHTML = `Error ${err.response.status}: ${message}`
        } finally {
            //console.log("Esto se ejecutará independientemente del try... catch");
        }
    }
    getData()
}

/**
 * Envia los datos a la base de datos y retorna una respuesta.
 * @param {id del usuario} id
 */
function guardarEdicion(id) {
    let formulario = document.forms['formulario-perfil-usuario']
    let id_recivido = id
    let nombre = formulario['nombre_usuario']
    let documento = formulario['documento']
    let email = formulario['email']

    let credenciales = new FormData()
    credenciales.append('id', id_recivido)
    credenciales.append('nombre', nombre.value)
    credenciales.append('documento', documento.value)
    credenciales.append('email', email.value)

    /*console.log(credenciales);*/

    axios
        .post(
            'http://'+host_server+'/index.php/perfil-usuario/editar_perfil/guardar_edicion_perfil',
            credenciales,
        )
        .then(function (response) {
            if (response.data == 'datos_guardados') {
                let mensaje = document.getElementById('mensaje-ok')
                mensaje.classList.add('activar')
                function desactivarMensaje() {
                    mensaje.classList.remove('activar')
                }
                setTimeout(desactivarMensaje, 3000)
            } else if (response.data == 'documento_existente') {
                let mensaje = document.getElementById('mensaje-error-documento')
                mensaje.classList.add('activar')
                function desactivarMensaje() {
                    mensaje.classList.remove('activar')
                }
                setTimeout(desactivarMensaje, 3000)
            } else if (response.data == 'email_existente') {
                let mensaje = document.getElementById('mensaje-error-email')
                mensaje.classList.add('activar')
                function desactivarMensaje() {
                    mensaje.classList.remove('activar')
                }
                setTimeout(desactivarMensaje, 3000)
            }
            console.log(response.data)
        })
        .catch(function (error) {
            console.log(error)
        })
}

/**
 * Retorna al perfil del usuario
 */
function cancelarEdicionPerfil() {
    window.location.replace('http://'+host_server+'/index.php/perfil')
}

/**
 * Muestra la vista para cambiar la contraseña
 */
function VistaCambiarContasena() {
    window.location.replace(
        'http://'+host_server+'/index.php/perfil-usuario/cambiar_contrasena',
    )
}

/**
 * Envia los datos para cambiar la contraseña del usuario y envia una respuesta.
 * @param {id del usuario} id
 */
function cambiarContrasena(id) {
    let formulario = document.forms['formulario-cambiar-contrasena']
    let id_recivido = id
    let contrasena_anterior = formulario['contrasena_anterior']
    let contrasena_nueva = formulario['contrasena_nueva']
    let contrasena_verificar = formulario['contrasena_verificar']

    let credenciales = new FormData()
    credenciales.append('id', id_recivido)
    credenciales.append('contrasena_anterior', contrasena_anterior.value)
    credenciales.append('contrasena_nueva', contrasena_nueva.value)
    credenciales.append('contrasena_verificar', contrasena_verificar.value)

    /*console.log(credenciales);*/

    axios
        .post(
            'http://'+host_server+'/index.php/lista_usuario/cambiar_contrasena/guardar_contrasena',
            credenciales,
        )
        .then(function (response) {
            if (response.data == 'contrasena_correcta') {
                let mensaje = document.getElementById('mensaje-ok-contrasena')
                mensaje.classList.add('activar')
                function desactivarMensaje() {
                    mensaje.classList.remove('activar')
                }
                setTimeout(desactivarMensaje, 3000)
            } else if (response.data == 'contrasena_incorrecta') {
                let mensaje = document.getElementById('mensaje-error-contrasena')
                mensaje.classList.add('activar')
                function desactivarMensaje() {
                    mensaje.classList.remove('activar')
                }
                setTimeout(desactivarMensaje, 3000)
            } else if (response.data == 'contrasena_no_coincide') {
                let mensaje = document.getElementById('mensaje-nocoincide')
                mensaje.classList.add('activar')
                function desactivarMensaje() {
                    mensaje.classList.remove('activar')
                }
                setTimeout(desactivarMensaje, 3000)
            }
            console.log(response.data)
        })
        .catch(function (error) {
            console.log(error)
        })
}
