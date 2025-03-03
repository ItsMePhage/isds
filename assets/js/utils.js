const Utils = {
    generateHSLColors(count) {
        const colors = [];
        const hue = 221;
        const saturation = 50;
        for (let i = 0; i < count; i++) {
            const lightness = 20 + (i * 50) / count;
            colors.push(`hsl(${hue}, ${saturation}%, ${lightness}%)`);
        }
        return colors;
    },

    select(el, all = false) {
        el = el.trim();
        return all ? $(el) : $(el).first();
    },

    on(type, el, listener, all = false) {
        if (all) {
            $(el).each(function () {
                $(this).on(type, listener);
            });
        } else {
            $(el).on(type, listener);
        }
    },

    onScroll(el, listener) {
        $(el).on("scroll", listener);
    },

    fetchData(url, data, successCallback, errorCallback = console.error) {
        $.ajax({
            url,
            type: "GET",
            data,
            dataType: "json",
            success: successCallback,
            error: errorCallback,
        });
    },

    postData(url, data, successCallback, errorCallback = console.error) {
        $.ajax({
            url,
            type: "POST",
            data,
            dataType: "json",
            success: successCallback,
            error: errorCallback,
        });
    },

    // New: Initialize Bootstrap Tooltips
    initTooltips() {
        $(document).ready(() => {
            const tooltipTriggerList = $('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.each(function () {
                new bootstrap.Tooltip(this);
            });
        });
    },
};

// Call initTooltips when the module is loaded
Utils.initTooltips();