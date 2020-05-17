/*!
 Column visibility buttons for Buttons and DataTables.
 2016 SpryMedia Ltd - datatables.net/license
*/
(function(f) {
    "function" === typeof define && define.amd
        ? define([
              "jquery",
              "datatables.net",
              "datatables.net-buttons"
          ], function(c) {
              return f(c, window, document);
          })
        : "object" === typeof exports
        ? (module.exports = function(c, e) {
              c || (c = window);
              (e && e.fn.dataTable) || (e = require("datatables.net")(c, e).$);
              e.fn.dataTable.Buttons || require("datatables.net-buttons")(c, e);
              return f(e, c, c.document);
          })
        : f(jQuery, window, document);
})(function(f, c, e, h) {
    c = f.fn.dataTable;
    f.extend(c.ext.buttons, {
        colvis: function(a, b) {
            return {
                extend: "collection",
                text: function(b) {
                    return b.i18n("buttons.colvis", "Column visibility");
                },
                className: "buttons-colvis",
                buttons: [
                    {
                        extend: "columnsToggle",
                        columns: b.columns,
                        columnText: b.columnText
                    }
                ]
            };
        },
        columnsToggle: function(a, b) {
            return a
                .columns(b.columns)
                .indexes()
                .map(function(a) {
                    return {
                        extend: "columnToggle",
                        columns: a,
                        columnText: b.columnText
                    };
                })
                .toArray();
        },
        columnToggle: function(a, b) {
            return {
                extend: "columnVisibility",
                columns: b.columns,
                columnText: b.columnText
            };
        },
        columnsVisibility: function(a, b) {
            return a
                .columns(b.columns)
                .indexes()
                .map(function(a) {
                    return {
                        extend: "columnVisibility",
                        columns: a,
                        visibility: b.visibility,
                        columnText: b.columnText
                    };
                })
                .toArray();
        },
        columnVisibility: {
            columns: h,
            text: function(a, b, d) {
                return d._columnText(a, d);
            },
            className: "buttons-columnVisibility",
            action: function(a, b, d, g) {
                a = b.columns(g.columns);
                b = a.visible();
                a.visible(
                    g.visibility !== h ? g.visibility : !(b.length && b[0])
                );
            },
            init: function(a, b, d) {
                var g = this;
                b.attr("data-cv-idx", d.columns);
                a.on("column-visibility.dt" + d.namespace, function(b, c) {
                    c.bDestroying ||
                        c.nTable != a.settings()[0].nTable ||
                        g.active(a.column(d.columns).visible());
                }).on("column-reorder.dt" + d.namespace, function(c, e, f) {
                    1 === a.columns(d.columns).count() &&
                        (b.text(d._columnText(a, d)),
                        g.active(a.column(d.columns).visible()));
                });
                this.active(a.column(d.columns).visible());
            },
            destroy: function(a, b, d) {
                a.off("column-visibility.dt" + d.namespace).off(
                    "column-reorder.dt" + d.namespace
                );
            },
            _columnText: function(a, b) {
                var d = a.column(b.columns).index(),
                    c = a
                        .settings()[0]
                        .aoColumns[d].sTitle.replace(/\n/g, " ")
                        .replace(/<br\s*\/?>/gi, " ")
                        .replace(/<select(.*?)<\/select>/g, "")
                        .replace(/<!\-\-.*?\-\->/g, "")
                        .replace(/<.*?>/g, "")
                        .replace(/^\s+|\s+$/g, "");
                return b.columnText ? b.columnText(a, d, c) : c;
            }
        },
        colvisRestore: {
            className: "buttons-colvisRestore",
            text: function(a) {
                return a.i18n("buttons.colvisRestore", "Restore visibility");
            },
            init: function(a, b, d) {
                d._visOriginal = a
                    .columns()
                    .indexes()
                    .map(function(b) {
                        return a.column(b).visible();
                    })
                    .toArray();
            },
            action: function(a, b, d, c) {
                b.columns().every(function(a) {
                    a =
                        b.colReorder && b.colReorder.transpose
                            ? b.colReorder.transpose(a, "toOriginal")
                            : a;
                    this.visible(c._visOriginal[a]);
                });
            }
        },
        colvisGroup: {
            className: "buttons-colvisGroup",
            action: function(a, b, d, c) {
                b.columns(c.show).visible(!0, !1);
                b.columns(c.hide).visible(!1, !1);
                b.columns.adjust();
            },
            show: [],
            hide: []
        }
    });
    return c.Buttons;
});
