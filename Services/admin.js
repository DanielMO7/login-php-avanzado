
/**
 *              ¡¡¡¡¡¡¡ IMPORTANTE !!!!!!!
 * Para el correcto funcionamiento del axios debes poner la url del servidor en el cual
 * esta corriendo el proyecto.
 */
let host_server = "localhost:8000";

function obtenerUsuarios() {
    const $formularios = document.getElementById('formulario-usuarios-script'),
        $fragment = document.createDocumentFragment()

    async function getData() {
        try {
            let res = await axios.get(
                'http://'+host_server+'/index.php/lista_usuarios/datos',
            ),
                json = await res.data

            //console.log(json);

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

                const td5 = document.createElement('td')
                td5.innerHTML =
                    '<input onclick="editarUsuarioAdmin(' +
                    dato.id +
                    ')" class="lista-user-boton" type="submit" value="Editar"><input onclick="eliminarUsuario('+dato.id+')" class="lista-user-boton" type="submit" value="Borrar">'
                tr.appendChild(td5)

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

function editarUsuarioAdmin(id) {
    window.location.replace(
        'http://'+host_server+'/index.php/lista_usuarios/editar_usuario?id=' +
        id,
    )
}

function datosUsuario(id) {
    const $formularios = document.getElementById('formulario-perfil-usuario'),
        $fragment = document.createDocumentFragment()

    async function getData() {
        try {
            let res = await axios.get(
                '/index.php/lista_usuarios/editar_usuario/datos?id=' +
                id,
            ),
                json = await res.data

            console.log(json)

            json.forEach((el) => {
                document.getElementsByName('nombre_usuario')[0].value =
                    el.nombre_usuario
                document.getElementsByName('documento')[0].value = el.documento
                document.getElementsByName('email')[0].value = el.email
                document.getElementsByName('rol')[0].value = el.rol
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

function guardarEdicionUsuario(id){
    let formulario = document.forms['formulario-perfil-usuario']
    let id_recivido = id
    let nombre = formulario['nombre_usuario']
    let documento = formulario['documento']
    let email = formulario['email']
    let rol = formulario['rol']

    let credenciales = new FormData()
    credenciales.append('id', id_recivido)
    credenciales.append('nombre', nombre.value)
    credenciales.append('documento', documento.value)
    credenciales.append('email', email.value)
    credenciales.append('rol', rol.value)

    /*console.log(credenciales);*/

    axios
        .post(
            'http://'+host_server+'/index.php/lista_usuarios/editar_usuario/guardar_edicion_usuarios',
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

function cancelarEdicionUsuario(){
    window.location.replace(
        'http://'+host_server+'/index.php/lista_usuarios'
    )
}

function eliminarUsuario(id) {
    let id_eliminar = id

    let credenciales = new FormData()
    credenciales.append('id', id_eliminar)
    axios
        .post(
            'http://'+host_server+'/index.php/lista_usuarios/borrar_usuario',
            credenciales,
        )
        .then(function (response) {
            if (response.data == 'borrado_correctamente') {
                function desactivarMensaje() {
                    window.location.replace(
                        'http://'+host_server+'/index.php/lista_usuarios'
                    )
                }
                alert('Usuario borrado correctamente.')
                
                setTimeout(desactivarMensaje, 1000)
            } 
            console.log(response.data)
        })
        .catch(function (error) {
            console.log(error)
        })
    
}