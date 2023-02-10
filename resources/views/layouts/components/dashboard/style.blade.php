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
    .nk-menu-link:hover .nk-menu-icon, .nk-menu-item.active > .nk-menu-link .nk-menu-icon, .nk-menu-item.current-menu > .nk-menu-link .nk-menu-icon, .nk-refwg-name .title{
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
    .menu-custom .disabled {
        color: #b3b3b3;
    }

    .btn-primary, .page-item.active .page-link {
        color: #fff !important;
        background-color: #C9B56D;
        border-color: #C9B56D;
    }
    .active > .menu-link, .menu-link.active, .link-primary, .nav-link {
        color: #C9B56D !important;
        border-color: #C9B56D !important;
    }
    .form-control:focus {
        border-color: #C9B56D !important;
    }
    .btn-outline-primary {
        color: #C9B56D;
        border-color: #C9B56D;
        background-color : transparent;
    }
    .nk-menu-footer .nk-menu-link:hover {
        color: #9E8424;
    }
    .menu-link:hover, .nav-link:hover, .nk-menu-footer .nk-menu-icon{
        color: #9E8424;
    }
    a:hover, .link-list a:hover, .nk-menu-sub .active > .nk-menu-link, .nk-menu-sub .nk-menu-link:hover {
        color: #9E8424;
    }
    .dropdown-menu-s1 {
        border-top: 3px solid #C9B56D;
    }
    .user-avatar {
        background: #C9B56D !important;
    }
    .btn-primary:hover, .btn-primary:active {
        color: #fff !important;
        background-color: #9E8424;
        border-color: #9E8424;
        box-shadow : none !important;
    }
    .logo-img {
        max-height: 70px !important;
    }
    @media (max-width: 1540px) {
        .logo-img {
            max-height: 50px;
        }
    }
    .aboutus-lastsection {
        margin-bottom: 60px;
    }
    .header.has-header-main-s1 {
        padding-top: 110px;
    }
    .header {
        min-height: 0;
    }
    @media (min-width: 1540px) {
        .nk-sidebar {
            width: 360px;
        }

        .nk-sidebar + .nk-wrap {
            padding-left: 360px;
        }

        .nk-sidebar .nk-sidebar-head {
            width: 360px;
        }

        .nk-sidebar + .nk-wrap > .nk-header-fixed {
            left: 360px;
        }
    }

    .carousel-indicators .active{
        background-color: #C9B56D !important;
    }

    .carousel-indicators [data-bs-target] {
        background-color: #d0d0d0;
    }

    .mh-50 {
        height: 280px;
    }

    .love {
        color : red;
    }

    .dropdown-body {
        max-height: 400px;
        overflow-y: auto;
    }

    .package-icon3 {
        position: absolute;
        bottom: 0;
        right: -80px;
        opacity: 15%;
    }
    .package-icon {
        position: absolute;
        bottom: 0;
        right: -70px;
        opacity: 15%;
    }
    .package-icon2 {
        position: absolute;
        top: -20px;
        right: -70px;
        opacity: 15%;
    }
    .donation-icon {
        position: absolute;
        bottom: -24px;
        right: -70px;
        opacity: 15%;
    }
    .nk-wgw-name.header-pack-color {
        margin: -15px -20px;
        padding: 20px;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
    }

    .nk-wgw-name.header-pack-color .title {
        color: white;
    }

    .col-xl-xxx {
        flex: 0 0 auto;
        width: 20%;
    }

    li span {
        display: block;
    }

    .after-opacity-90:after {
        opacity: 0.6 !important;
    }
    .after-opacity-95:after {
        opacity: 0.7 !important;
    }

    .nodot ul {
        list-style: none;
    }

    .nodot.list li:before {
        content : none;
    }

    .nodot li {
        padding-left : 0;
    }

</style>
