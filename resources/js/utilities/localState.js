/**
 * setItem - Function
 * @param {string} name
 * @param {*} value
 */
export function setItem(name, value) {
  try {
    localStorage.setItem(name, JSON.stringify(value));
  } catch (error) {
    console.error('Error setting item in Local storage');
  }
}

/**
 * getItem
 * @param {string} name
 * @return {*}
 */
export function getItem(name) {
  try {
    return JSON.parse(localStorage.getItem(name));
  } catch (error) {
    return null;
  }
}

/**
 * removeItem
 * @param {string} name
 */
export function removeItem(name) {
  try {
    localStorage.removeItem(name);
  } catch (error) {
    console.error('Error deleting item in Local storage');
  }
}

/**
 * setMultiple
 * @param {object} obj
 */
export function setMultiple(obj) {
  try {
    Object.keys(obj).forEach(name => {
      setItem(name, obj[name]);
    });
  } catch (error) {
    console.error('Error setting items to Local storage');
  }
}

/**
 * getAll
 * @return {object}
 */
export function getAll() {
  try {
    return Object.keys(localStorage).reduce((result, name, key) => {
      result[key] = JSON.parse(getItem(name));
      return result;
    }, {});
  } catch (error) {
    return {};
  }
}

/**
 * removeAll
 * @param {string} name
 */
export function removeAll(name) {
  try {
    localStorage.clear();
  } catch (error) {
    console.error('Error clearing Local storage');
  }
}

/**
 * authService
 * @return bool
 */
export function authService() {
  const getUser = JSON.parse(localStorage.getItem('currentUser'));
  if (getUser) return true
  else return false
}
