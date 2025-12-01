<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product API Viewer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex flex-col items-center justify-start p-6 gap-6">

    <h1 class="text-3xl font-bold text-gray-800">Product API Viewer</h1>

    <div class="bg-white shadow-xl rounded-xl p-6 w-full max-w-4xl flex flex-col gap-4">

        <!-- API Documentation -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">API Documentation (Live Data)</h2>
            
            <div class="space-y-4">

                <!-- GET ALL PRODUCTS -->
                <details class="border p-4 rounded-lg bg-gray-50">
                    <summary class="font-semibold text-gray-700 cursor-pointer">GET /api/products</summary>
                    <div class="flex gap-2 mt-2 mb-2">
                        <button onclick="loadExample('index','application/json')"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded font-semibold text-xs">
                            JSON
                        </button>
                        <button onclick="loadExample('index','application/xml')"
                                class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded font-semibold text-xs">
                            XML
                        </button>
                    </div>
                    <pre class="bg-gray-900 text-green-400 p-2 rounded overflow-auto max-h-48 text-xs" id="example-index">
Loading...
                    </pre>
                </details>

                <!-- GET SINGLE PRODUCT -->
                <details class="border p-4 rounded-lg bg-gray-50">
                    <summary class="font-semibold text-gray-700 cursor-pointer">GET /api/products/{id}</summary>
                    <div class="flex gap-2 mt-2 mb-2">
                        <button onclick="loadExample('show','application/json')"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded font-semibold text-xs">
                            JSON
                        </button>
                        <button onclick="loadExample('show','application/xml')"
                                class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded font-semibold text-xs">
                            XML
                        </button>
                    </div>
                    <pre class="bg-gray-900 text-green-400 p-2 rounded overflow-auto max-h-48 text-xs" id="example-show">
Loading...
                    </pre>
                </details>

                <!-- CREATE PRODUCT -->
                <details class="border p-4 rounded-lg bg-gray-50">
                    <summary class="font-semibold text-gray-700 cursor-pointer">POST /api/products</summary>
                    <form id="create-form" class="flex flex-col gap-3 mt-2">
                        <input type="text" name="name" placeholder="Name" class="border px-3 py-2 rounded" required>
                        <input type="text" name="description" placeholder="Description" class="border px-3 py-2 rounded">
                        <input type="number" name="price" placeholder="Price" class="border px-3 py-2 rounded" required>
                        <input type="text" name="category" placeholder="Category" class="border px-3 py-2 rounded" required>
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-2 rounded font-semibold text-sm w-32">
                            Add Product
                        </button>
                    </form>
                    <pre class="bg-gray-900 text-green-400 p-2 rounded overflow-auto max-h-48 text-xs mt-2" id="example-create">
                Response will appear here...
                    </pre>
                </details>

                <!-- DELETE PRODUCT -->
                <details class="border p-4 rounded-lg bg-gray-50">
                    <summary class="font-semibold text-gray-700 cursor-pointer">DELETE /api/products/{id}</summary>
                    <form id="delete-form" class="flex gap-3 mt-2 items-center">
                        <input type="number" name="id" placeholder="Product ID" class="border px-3 py-2 rounded w-32" required>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded font-semibold text-sm">
                            Delete Product
                        </button>
                    </form>
                    <pre class="bg-gray-900 text-green-400 p-2 rounded overflow-auto max-h-48 text-xs mt-2" id="example-delete">
                Response will appear here...
                    </pre>
                </details>

            </div>
        </div>
    </div>

</div>

<script>
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

// Load example for docs
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

        // Clear form
        form.reset();
        // Refresh products
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

        // Refresh products
        loadExample('index','application/json');
    } catch (err) {
        output.textContent = "Error: " + err;
    }
});

// Load JSON examples by default
loadExample('index','application/json');
loadExample('show','application/json');
</script>

</body>
</html>
