export default function ({ $auth, redirect }) {
  const user = $auth.user
  if (!user || !user.roles.includes('ROLE_ADMIN')) {
    redirect('/')
  }
}
