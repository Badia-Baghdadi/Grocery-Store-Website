<style>
    .search-box {
        width: 500px;
        height: 35px;
        padding: 0 45px 0 15px;
        border: 1px solid #ccc;
        font-size: 13px;
        box-sizing: border-box;
        outline: none;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .search-button {
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        background: none;
        border: none;
        padding: 0;
        margin: 0;
        cursor: pointer;
    }

    .search-button svg {
        width: 20px;
        height: 20px;
        color: #ccc;
    }

    #searchInput {
        font-size: 12px;
        position: absolute;
        bottom: 20%;
        border: none;
    }

    #suggestions {
        top: 100%;
        position: absolute;
        width: 100%;
        background-color: #fff;
        border: 1px solid #ddd;
        border-top: none;
        border-radius: 0 0 5px 5px;
        z-index: 100;
        max-height: 200px;
        overflow-y: auto;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    }

    .suggestion-item {
        padding: 10px;
        cursor: pointer;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .suggestion-item:last-child {
        border-bottom: none;
    }

    .suggestion-item:hover {
        background-color: #f0f0f0;
    }
</style>

<div class="search-box" style="position: relative;">

    <input type="text" id="searchInput" placeholder="Search for cars e.g. Tesla" autocomplete="off">
    <button class="search-button" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
    </button>
    <div id="suggestions"></div>
</div>

<script src="js/search_script.js"></script>