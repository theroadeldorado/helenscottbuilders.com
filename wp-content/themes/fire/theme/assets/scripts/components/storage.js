let inMemoryStorage = {};
let storage = localStorage;

export class FireStorage {
  get isSupported() {
    try {
      const key = 'is_session_storage_supported';
      storage.setItem(key, key);
      storage.removeItem(key);
      return true;
    } catch (error) {
      return false;
    }
  }

  static getItem(key) {
    if (this.isSupported()) {
      return storage.getItem(key);
    }
    return inMemoryStorage[key] || null;
  }

  static setItem(key, value) {
    if (this.isSupported()) {
      storage.setItem(key, value);
    } else {
      inMemoryStorage[key] = value;
    }
  }

  static removeItem(key) {
    if (this.isSupported()) {
      storage.removeItem(key);
    } else {
      delete inMemoryStorage[key];
    }
  }

  static clear(key) {
    if (this.isSupported()) {
      storage.clear();
    } else {
      inMemoryStorage = {};
    }
  }

  static key(n) {
    if (this.isSupported()) {
      return storage.key(n);
    } else {
      return Object.keys(inMemoryStorage)[n] || null;
    }
  }
}
