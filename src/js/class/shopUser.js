export class ShopUser {
  constructor(email, cart) {
    // Verificar si ya existe una instancia única
    if (!ShopUser.instance) {
      // Intentar cargar el usuario almacenado en sessionStorage
      const storedUser = ShopUser.loadFromSessionStorage();

      if (storedUser) {
        // Si ya hay un usuario almacenado en sessionStorage, usar esa instancia
        Object.assign(this, storedUser); // Copy properties to the current instance
        ShopUser.instance = this;
      } else {
        // Si no existe, crear una nueva instancia y almacenarla en sessionStorage
        this.email = email;
        this.cart = cart;
        this.saveToSessionStorage();
        ShopUser.instance = this;
      }
    }

    // Devolver la instancia única
    return ShopUser.instance;
  }

  // Método para cargar el usuario desde sessionStorage
  static loadFromSessionStorage() {
    const storedUser = JSON.parse(sessionStorage.getItem('User'));
    return storedUser ? storedUser : null;
  }

  // Método para guardar el usuario en sessionStorage
  saveToSessionStorage() {
    sessionStorage.setItem('User', JSON.stringify(this));
  }
}


