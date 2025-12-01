<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product API Viewer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

<!-- Navbar -->
<nav class="bg-white shadow-lg w-full fixed top-0 left-0 z-50">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="flex justify-between h-16 items-center">
            <!-- Left: Logo/Title -->
            <div class="flex-shrink-0 text-2xl font-extrabold text-indigo-600">
                Product API Viewer
            </div>
            <!-- Right: Members Button -->
            <div>
                <button id="members-btn" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-xl font-semibold shadow-md transition transform hover:scale-105">
                    Members
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="min-h-screen flex flex-col items-center justify-start p-6 gap-8 pt-32 w-full">

    <!-- Project Title -->
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-6 text-center leading-tight">
        BSIT 4-2 MIDTERM PROJECT IN SIA2
    </h1>

    <div class="bg-white shadow-2xl rounded-3xl p-10 w-full max-w-6xl flex flex-col gap-8">

        <!-- API Documentation -->
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">API Documentation (Live Data)</h2>
            
            <div class="space-y-6">

                <!-- GET ALL PRODUCTS -->
                <details class="border border-gray-200 p-5 rounded-2xl bg-gray-50 hover:bg-gray-100 transition duration-300 shadow-sm">
                    <summary class="font-semibold text-gray-700 cursor-pointer text-lg">GET /api/products</summary>
                    <div class="flex gap-3 mt-3 mb-3">
                        <button onclick="loadExample('index','application/json')"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-lg font-semibold text-sm shadow transition transform hover:scale-105">
                            JSON
                        </button>
                        <button onclick="loadExample('index','application/xml')"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg font-semibold text-sm shadow transition transform hover:scale-105">
                            XML
                        </button>
                    </div>
                    <pre class="bg-gray-900 text-green-400 p-4 rounded-xl overflow-auto max-h-56 text-sm shadow-inner" id="example-index">
Loading...
                    </pre>
                </details>

                <!-- GET SINGLE PRODUCT -->
                <details class="border border-gray-200 p-5 rounded-2xl bg-gray-50 hover:bg-gray-100 transition duration-300 shadow-sm">
                    <summary class="font-semibold text-gray-700 cursor-pointer text-lg">GET /api/products/{id}</summary>
                    <div class="flex gap-3 mt-3 mb-3 items-center">
                        <input type="number" id="product-id-input" placeholder="Enter ID" class="border px-3 py-2 rounded-lg w-28 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        <button id="load-product-json"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded-lg font-semibold text-sm shadow transition transform hover:scale-105">
                            JSON
                        </button>
                        <button id="load-product-xml"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg font-semibold text-sm shadow transition transform hover:scale-105">
                            XML
                        </button>
                    </div>
                    <pre class="bg-gray-900 text-green-400 p-4 rounded-xl overflow-auto max-h-56 text-sm shadow-inner" id="example-show">
Loading...
                    </pre>
                </details>

                <!-- CREATE PRODUCT -->
                <details class="border border-gray-200 p-5 rounded-2xl bg-gray-50 hover:bg-gray-100 transition duration-300 shadow-sm">
                    <summary class="font-semibold text-gray-700 cursor-pointer text-lg">POST /api/products</summary>
                    <form id="create-form" class="flex flex-col gap-3 mt-3">
                        <input type="text" name="name" placeholder="Name" class="border px-3 py-2 rounded-lg focus:ring-2 focus:ring-purple-400 focus:outline-none" required>
                        <input type="text" name="description" placeholder="Description" class="border px-3 py-2 rounded-lg focus:ring-2 focus:ring-purple-400 focus:outline-none">
                        <input type="number" name="price" placeholder="Price" class="border px-3 py-2 rounded-lg focus:ring-2 focus:ring-purple-400 focus:outline-none" required>
                        <input type="text" name="category" placeholder="Category" class="border px-3 py-2 rounded-lg focus:ring-2 focus:ring-purple-400 focus:outline-none" required>
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-xl font-semibold text-sm shadow-md transition transform hover:scale-105 w-36">
                            Add Product
                        </button>
                    </form>
                    <pre class="bg-gray-900 text-green-400 p-4 rounded-xl overflow-auto max-h-56 text-sm mt-2 shadow-inner" id="example-create">
Response will appear here...
                    </pre>
                </details>

                <!-- DELETE PRODUCT -->
                <details class="border border-gray-200 p-5 rounded-2xl bg-gray-50 hover:bg-gray-100 transition duration-300 shadow-sm">
                    <summary class="font-semibold text-gray-700 cursor-pointer text-lg">DELETE /api/products/{id}</summary>
                    <form id="delete-form" class="flex gap-3 mt-3 items-center">
                        <input type="number" name="id" placeholder="Product ID" class="border px-3 py-2 rounded-lg w-32 focus:ring-2 focus:ring-red-400 focus:outline-none" required>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl font-semibold text-sm shadow-md transition transform hover:scale-105">
                            Delete Product
                        </button>
                    </form>
                    <pre class="bg-gray-900 text-green-400 p-4 rounded-xl overflow-auto max-h-56 text-sm mt-2 shadow-inner" id="example-delete">
Response will appear here...
                    </pre>
                </details>

            </div>
        </div>
    </div>

</div>

<!-- Members Modal -->
<div id="members-modal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-start justify-center z-50 pt-24">
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-3xl shadow-2xl w-80 p-6 relative animate-fadeIn border-2 border-white">
        <h2 class="text-2xl font-bold mb-5 text-white text-center">Group Members</h2>
        <ul class="list-disc pl-6 space-y-2 text-white font-semibold text-lg">
            <li>Dob, Anthony B. - Programmer</li>
            <li>Fuentes Paul Cris F. - Project manager</li>
            <li>Gavino Irish F. - System analyst</li>
            <li>Gautane Liza Mae F. - technical writer</li>
        </ul>
        <button id="close-members" class="absolute top-3 right-3 text-white hover:text-gray-300 font-bold text-2xl">&times;</button>
    </div>
</div>

<script>
// Your previous JS code here (API fetch, form submit, modal logic)
const apiBase = '/api/products'; // Laravel API base

// Beautify XML
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

// Load example for docs (GET ALL PRODUCTS)
async function loadExample(type, format) {
    let url = apiBase;
    let outputId = '';
    if (type === 'index') outputId = 'example-index';
    else if (type === 'show') {
        outputId = 'example-show';
        url += '/1'; // sample product ID
    }
    const output = document.getElementById(outputId);
    output.textContent = "Loading...";
    try {
        const res = await fetch(url, { headers: { 'Accept': format } });
        const data = format === 'application/json' ? await res.json() : await res.text();
        output.textContent = format === 'application/json' ? JSON.stringify(data, null, 2) : formatXML(data);
    } catch (err) {
        output.textContent = "Error loading data: " + err;
    }
}

// CREATE product
document.getElementById('create-form').addEventListener('submit', async function(e){
    e.preventDefault();
    const form = e.target;
    const output = document.getElementById('example-create');
    const formData = Object.fromEntries(new FormData(form).entries());

    output.textContent = "Loading...";
    try {
        const res = await fetch(apiBase, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(formData)
        });
        const data = await res.json();
        output.textContent = JSON.stringify(data, null, 2);

        form.reset();
        loadExample('index','application/json');
    } catch (err) {
        output.textContent = "Error: " + err;
    }
});

// DELETE product
document.getElementById('delete-form').addEventListener('submit', async function(e){
    e.preventDefault();
    const form = e.target;
    const output = document.getElementById('example-delete');
    const id = form.id.value || form.querySelector('input[name="id"]').value;

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

// Load single product dynamically by input
const loadJsonBtn = document.getElementById('load-product-json');
const loadXmlBtn = document.getElementById('load-product-xml');
const productInput = document.getElementById('product-id-input');
const productOutput = document.getElementById('example-show');

loadJsonBtn.addEventListener('click', () => {
    const id = productInput.value;
    if (!id) return alert("Please enter a Product ID");
    loadProduct(id, 'application/json');
});

loadXmlBtn.addEventListener('click', () => {
    const id = productInput.value;
    if (!id) return alert("Please enter a Product ID");
    loadProduct(id, 'application/xml');
});

// Press Enter to load product
productInput.addEventListener('keyup', (e) => {
    if (e.key === 'Enter') {
        const id = productInput.value;
        if (!id) return alert("Please enter a Product ID");
        loadProduct(id, 'application/json');
    }
});

async function loadProduct(id, format) {
    productOutput.textContent = "Loading...";
    try {
        const res = await fetch(`${apiBase}/${id}`, { headers: { 'Accept': format } });
        if (!res.ok) throw new Error(res.status + ' ' + res.statusText);
        const data = format === 'application/json' ? await res.json() : await res.text();
        productOutput.textContent = format === 'application/json' ? JSON.stringify(data, null, 2) : formatXML(data);
    } catch (err) {
        productOutput.textContent = "Error loading data: " + err;
    }
}

// Load JSON examples by default
loadExample('index','application/json');
loadExample('show','application/json');

// -----------------
// Members Modal Logic
// -----------------
const membersBtn = document.getElementById('members-btn');
const membersModal = document.getElementById('members-modal');
const closeMembers = document.getElementById('close-members');

membersBtn.addEventListener('click', () => {
    membersModal.classList.remove('hidden');
    membersModal.classList.add('flex');
});

closeMembers.addEventListener('click', () => {
    membersModal.classList.add('hidden');
    membersModal.classList.remove('flex');
});

// Close modal if clicked outside content
membersModal.addEventListener('click', (e) => {
    if (e.target === membersModal) {
        membersModal.classList.add('hidden');
        membersModal.classList.remove('flex');
    }
});
</script>

</body>
</html>
