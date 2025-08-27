// utils.js - Utility Functions and Helpers

/**
 * Generate HSL colors for charts
 * @param {number} count - Number of colors to generate
 * @returns {Array} Array of HSL color strings
 */
function generateHSLColors(count) {
  let colors = [];
  const hue = 221;
  const saturation = 50;

  for (let i = 0; i < count; i++) {
    let lightness = 20 + i * (50 / count);
    colors.push(`hsl(${hue}, ${saturation}%, ${lightness}%)`);
  }

  return colors;
}

/**
 * Select elements with jQuery wrapper
 * @param {string} el - Element selector
 * @param {boolean} all - Return all elements or just first
 * @returns {jQuery} jQuery object
 */
const select = (el, all = false) => {
  el = el.trim();
  if (all) {
    return $(el);
  } else {
    return $(el).first();
  }
};

/**
 * Event listener wrapper
 * @param {string} type - Event type
 * @param {string} el - Element selector
 * @param {Function} listener - Event handler
 * @param {boolean} all - Apply to all elements
 */
const on = (type, el, listener, all = false) => {
  if (all) {
    $(el).each(function () {
      $(this).on(type, listener);
    });
  } else {
    $(el).on(type, listener);
  }
};

/**
 * Scroll event listener wrapper
 * @param {string} el - Element selector
 * @param {Function} listener - Scroll handler
 */
const onscroll = (el, listener) => {
  $(el).on("scroll", listener);
};

/**
 * Pad numbers with leading zero
 * @param {number} n - Number to pad
 * @returns {string} Padded number string
 */
function pad(n) {
  return n < 10 ? "0" + n : n;
}

/**
 * Format datetime for input fields
 * @param {Date} datetime - Date object
 * @returns {string} Formatted datetime string
 */
function formatDatetimeForInput(datetime) {
  const date = new Date(datetime);
  return date.getFullYear() +
    "-" + pad(date.getMonth() + 1) +
    "-" + pad(date.getDate()) +
    "T" + pad(date.getHours()) +
    ":" + pad(date.getMinutes());
}

// Export for use in other modules (if using ES6 modules)
// export { generateHSLColors, select, on, onscroll, pad, formatDatetimeForInput };