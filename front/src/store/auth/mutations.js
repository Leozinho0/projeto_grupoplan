const SET_AUTENTICADO = (state) => {
  state.autenticado = true;
}

const DELETE_AUTENTICADO = (state) => {
  state.autenticado = false;
}

const SET_USUARIO = (state, usuario) => {
  state.usuario = usuario;
}

const DELETE_USUARIO = (state) => {
  state.usuario = null;
}

export default{
  SET_AUTENTICADO,
  DELETE_AUTENTICADO,
  SET_USUARIO,
  DELETE_USUARIO,
}