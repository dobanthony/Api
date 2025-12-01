<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product API Viewer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans pt-12 sm:pt-20">

<!-- ================= NAVBAR ================= -->
<nav class="bg-white shadow-lg w-full fixed top-0 left-0 z-50">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="flex justify-between h-16 items-center">

            <!-- Title -->
            <div class="text-2xl font-extrabold text-indigo-600">
                Product API Viewer
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-4">
                <button id="members-btn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl font-semibold shadow-md transition">
                    Members
                </button>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <button id="hamburger-btn" class="md:hidden focus:outline-none">
                <svg class="w-8 h-8 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Dropdown -->
        <div id="mobile-menu" class="hidden flex-col bg-white shadow-md rounded-xl mt-2 p-4 md:hidden">
            <button id="members-btn-mobile" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl font-semibold shadow-md transition w-full">
                Members
            </button>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div class="min-h-screen flex flex-col items-center justify-start p-4 sm:p-6 gap-8 pt-32 w-full">

    <!-- Project Title -->
    <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-800 mb-4 text-center">
        BSIT 4-2 MIDTERM PROJECT IN SIA2
    </h1>

    <div class="bg-white shadow-2xl rounded-3xl p-6 sm:p-10 w-full max-w-6xl flex flex-col gap-8">

        <!-- API Documentation Section -->
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">API Documentation (Live Data)</h2>

            <div class="space-y-6">

                <!-- GET ALL PRODUCTS -->
                <details class="border border-gray-200 p-5 rounded-2xl bg-gray-50 hover:bg-gray-100 transition">
                    <summary class="font-semibold text-gray-700 cursor-pointer text-lg">
                        GET /api/products
                    </summary>

                    <div class="flex flex-wrap gap-3 mt-3 mb-3">
                        <button onclick="loadExample('index','application/json')"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-lg shadow">
                            JSON
                        </button>
                        <button onclick="loadExample('index','application/xml')"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg shadow">
                            XML
                        </button>
                    </div>

                    <pre class="bg-gray-900 text-green-400 p-4 rounded-xl overflow-auto max-h-56 text-xs sm:text-sm shadow-inner"
                         id="example-index">
Loading...
                    </pre>
                </details>

                <!-- GET SINGLE PRODUCT -->
                <details class="border border-gray-200 p-5 rounded-2xl bg-gray-50 hover:bg-gray-100 transition">
                    <summary class="font-semibold text-gray-700 cursor-pointer text-lg">
                        GET /api/products/{id}
                    </summary>

                    <div class="flex flex-wrap gap-3 mt-3 mb-3 items-center">
                        <input type="number" id="product-id-input" placeholder="Enter ID"
                               class="border px-3 py-2 rounded-lg w-28 focus:ring-2 focus:ring-indigo-400">
                        <button id="load-product-json"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-lg shadow">
                            JSON
                        </button>
                        <button id="load-product-xml"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg shadow">
                            XML
                        </button>
                    </div>

                    <pre class="bg-gray-900 text-green-400 p-4 rounded-xl overflow-auto max-h-56 text-xs sm:text-sm shadow-inner"
                         id="example-show">
Loading...
                    </pre>
                </details>

                <!-- CREATE PRODUCT -->
                <details class="border border-gray-200 p-5 rounded-2xl bg-gray-50 hover:bg-gray-100 transition">
                    <summary class="font-semibold text-gray-700 cursor-pointer text-lg">
                        POST /api/products
                    </summary>

                    <form id="create-form" class="flex flex-col gap-3 mt-3">
                        <input type="text" name="name" placeholder="Name" class="border px-3 py-2 rounded-lg" required>
                        <input type="text" name="description" placeholder="Description" class="border px-3 py-2 rounded-lg">
                        <input type="number" name="price" placeholder="Price" class="border px-3 py-2 rounded-lg" required>
                        <input type="text" name="category" placeholder="Category" class="border px-3 py-2 rounded-lg" required>

                        <button type="submit"
                                class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-xl w-40 shadow">
                            Add Product
                        </button>
                    </form>

                    <pre class="bg-gray-900 text-green-400 p-4 rounded-xl overflow-auto max-h-56 text-xs sm:text-sm mt-3 shadow-inner"
                         id="example-create">
Response will appear here...
                    </pre>
                </details>

                <!-- DELETE PRODUCT -->
                <details class="border border-gray-200 p-5 rounded-2xl bg-gray-50 hover:bg-gray-100 transition">
                    <summary class="font-semibold text-gray-700 cursor-pointer text-lg">
                        DELETE /api/products/{id}
                    </summary>

                    <form id="delete-form" class="flex flex-wrap gap-3 mt-3 items-center">
                        <input type="number" name="id" placeholder="Product ID"
                               class="border px-3 py-2 rounded-lg w-32" required>

                        <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl shadow">
                            Delete Product
                        </button>
                    </form>

                    <pre class="bg-gray-900 text-green-400 p-4 rounded-xl overflow-auto max-h-56 text-xs sm:text-sm mt-3 shadow-inner"
                         id="example-delete">
Response will appear here...
                    </pre>
                </details>

            </div>
        </div>
    </div>
</div>

<!-- MEMBERS MODAL -->
<div id="members-modal"
     class="fixed inset-0 bg-black bg-opacity-40 hidden items-start justify-center z-50 pt-24">
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-3xl shadow-2xl w-80 p-6 relative border-2 border-white">
        <h2 class="text-2xl font-bold mb-5 text-white text-center">Group Members</h2>

        <ul class="list-disc pl-6 space-y-2 text-white font-semibold text-lg">
            <li>Dob, Anthony B. - Programmer</li>
            <li>Fuentes Paul Cris F. - Project Manager</li>
            <li>Gavino Irish F. - System Analyst</li>
            <li>Gautane Liza Mae F. - Technical Writer</li>
        </ul>

        <button id="close-members"
                class="absolute top-3 right-3 text-white hover:text-gray-300 font-bold text-2xl">
            &times;
        </button>
    </div>
</div>

<!-- ================= JS SCRIPT ================= -->
<script>
const apiBase = '/api/products';

/* -------------------------
   Hamburger Dropdown Logic
--------------------------- */
const hamburger = document.getElementById("hamburger-btn");
const mobileMenu = document.getElementById("mobile-menu");

hamburger.addEventListener("click", () => {
    mobileMenu.classList.toggle("hidden");
    mobileMenu.classList.toggle("flex");
});

/* Sync Members Button Between Desktop & Mobile */
document.getElementById("members-btn-mobile").addEventListener("click", () => {
    document.getElementById("members-btn").click();
});

/* Members Modal Logic */
const membersBtn = document.getElementById('members-btn');
const membersModal = document.getElementById('members-modal');
const closeMembers = document.getElementById('close-members');

membersBtn.addEventListener('click', () => {
    membersModal.classList.remove('hidden');
    membersModal.classList.add('flex');
});

closeMembers.addEventListener('click', () => {
    membersModal.classList.add('hidden');
});

/* Beautify XML */
function formatXML(xml) {
    let formatted = '';
    let indent = '';
    const tab = '  ';
    xml.split(/>\s*</).forEach((node) => {
        if (node.match(/^\/\w/)) indent = indent.substring(tab.length);
        formatted += indent + '<' + node + '>\n';
        if (node.match(/^<?\w[^>]*[^\/]$/) && !node.startsWith("?xml") && !node.endsWith("/")) indent += tab;
    });
    return formatted.trim();
}

/* Load Example */
async function loadExample(type, format) {
    let url = apiBase;
    let outputId = type === 'index' ? 'example-index' : 'example-show';

    if (type === 'show') url += '/1';

    const output = document.getElementById(outputId);
    output.textContent = "Loading...";

    try {
        const res = await fetch(url, { headers: { 'Accept': format } });
        const data = (format === 'application/json') ? await res.json() : await res.text();

        output.textContent = (format === 'application/json')
            ? JSON.stringify(data, null, 2)
            : formatXML(data);

    } catch (err) {
        output.textContent = "Error: " + err;
    }
}

/* CREATE Product */
document.getElementById('create-form').addEventListener('submit', async function(e){
    e.preventDefault();
    const output = document.getElementById('example-create');
    const formData = Object.fromEntries(new FormData(e.target).entries());
    output.textContent = "Loading...";

    try {
        const res = await fetch(apiBase, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(formData)
        });
        const data = await res.json();
        output.textContent = JSON.stringify(data, null, 2);
        e.target.reset();
        loadExample('index','application/json');
    } catch (err) {
        output.textContent = "Error: " + err;
    }
});

/* DELETE Product */
document.getElementById('delete-form').addEventListener('submit', async function(e){
    e.preventDefault();
    const output = document.getElementById('example-delete');
    const id = e.target.id.value;

    output.textContent = "Loading...";

    try {
        const res = await fetch(`${apiBase}/${id}`, {
            method: 'DELETE',
            headers: { 'Accept': 'application/json' }
        });
        const data = await res.json();
        output.textContent = JSON.stringify(data, null, 2);
        loadExample('index','application/json');
    } catch (err) {
        output.textContent = "Error: " + err;
    }
});

/* Load Single Product */
async function loadProduct(id, format) {
    const output = document.getElementById('example-show');
    output.textContent = "Loading...";

    try {
        const res = await fetch(`${apiBase}/${id}`, { headers: { 'Accept': format } });
        const data = format === 'application/json' ? await res.json() : await res.text();
        output.textContent = format === 'application/json'
            ? JSON.stringify(data, null, 2)
            : formatXML(data);
    } catch (err) {
        output.textContent = "Error: " + err;
    }
}

/* Buttons for loading product */
document.getElementById('load-product-json').onclick = () => {
    const id = document.getElementById('product-id-input').value;
    if (!id) return alert("Enter a Product ID");
    loadProduct(id, 'application/json');
};
document.getElementById('load-product-xml').onclick = () => {
    const id = document.getElementById('product-id-input').value;
    if (!id) return alert("Enter a Product ID");
    loadProduct(id, 'application/xml');
};

/* Enter to load product */
document.getElementById('product-id-input').addEventListener('keyup', (e) => {
    if (e.key === 'Enter') {
        const id = e.target.value;
        loadProduct(id, 'application/json');
    }
});

/* Load default examples */
loadExample('index','application/json');
loadExample('show','application/json');
</script>

</body>
</html>
