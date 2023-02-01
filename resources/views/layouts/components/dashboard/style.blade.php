<style>
    thead,
    tbody,
    tfoot,
    tr,
    td,
    th {
        vertical-align: middle;
    }

    .gauge-container {
        /* padding: 20px;
        margin-top: 80px; */
        display: flex;
        justify-content: space-around;
    }

    .gauge {
        height: 220px;
        width: 300px;
    }

    .gauge .dxg-range.dxg-background-range {
        fill: url(#gradientGauge);
    }

    .gauge .dxg-line {
        transform: scaleX(1.04) scaleY(1.03) translate(-4px, -4px);
    }

    .gauge .dxg-line path:first-child,
    .gauge .dxg-line path:last-child {
        display: none;
    }

    .gauge .dxg-line path:nth-child(2),
    .gauge .dxg-line path:nth-child(6) {
        stroke: #ed811c;
    }

    .gauge .dxg-line path:nth-child(3),
    .gauge .dxg-line path:nth-child(5) {
        stroke: #a7db29;
    }

    .gauge .dxg-line path:nth-child(4) {
        stroke: #25cd6b;
    }

    .gauge .dxg-elements text:first-child {
        transform: translate(19px, 13px);
    }

    .gauge .dxg-elements text:last-child {
        transform: translate(-27px, 14px);
    }

    .gauge .dxg-value-indicator path {
        transform: scale(1.2) translate(0, -5px);
        transform-origin: center center;
    }

    .gauge .dxg-value-indicator .dxg-title {
        text-transform: uppercase;
    }

    .gauge .dxg-value-indicator .dxg-title text:first-child {
        transform: translateY(5px);
    }

    .gauge .dxg-value-indicator .dxg-spindle-border:nth-child(4),
    .gauge .dxg-value-indicator .dxg-spindle-hole:nth-child(5) {
        transform: translate(0, -109px);
    }

    .gauge .dxg-value-indicator .dxg-spindle-hole {
        fill: #26323a;
    }

    .color-red {
        stop-color: #e23131;
    }

    .color-yellow {
        stop-color: #fbe500;
    }

    .color-green {
        stop-color: #25cd6b;
    }

    .spinner-border-sm {
        border-width: 0.1em;
    }

    .fw-500 {
        font-weight: 500;
    }
    .logo-img {
        max-height : 50px;
    }
    .btn-primary, .btn, .btn:focus {
        color: #fff;
        background-color: #C9B56D;
        border-color: #C9B56D;
    }
    .btn:hover {
        color: #fff;
        background-color: #aa995d;
        border-color: #aa995d;
    }
    .menu-link:hover, .active > .menu-link, .menu-link.active {
        color: #C9B56D;
    }
    .btn-primary:disabled, .btn-primary.disabled {
        color: #fff;
        background-color: #cab979;
        border-color: #cab979;
    }
    .nk-menu-link:hover, .active > .nk-menu-link {
        color: #C9B56D;
    }
    .nk-menu-link:hover .nk-menu-icon, .nk-menu-item.active > .nk-menu-link .nk-menu-icon, .nk-menu-item.current-menu > .nk-menu-link .nk-menu-icon {
        color: #C9B56D;
    }
    a {
        color: #C9B56D;
        text-decoration: none;
    }
    .not-own {
        position:absolute;
        height: 100%;
        width: 100%;
        background-color: rgb(239 239 239 / 50%);
        z-index: 99;filter: blur(1px);
    }
    .icon-notif {
        display: inline-flex;
    }
</style>
