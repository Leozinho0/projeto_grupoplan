export default function Auth({next, store}) {
  let isLoggedIn = store.state.auth.autenticado;
  
  if(isLoggedIn) {
    return next({ name:'Home' });
  } 

  return next();
}