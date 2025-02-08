<div>
    <canvas id="signature-pad" style="border: 1px solid #ccc; width: 100%; height: 200px;"></canvas>
    <input type="hidden" id="signature-input" name="{{ $statePath }}" value="{{ $state }}" />

    <button type="button" onclick="clearSignature()">Limpiar Firma</button>
</div>

<script>
    const canvas = document.getElementById('signature-pad');
    const signatureInput = document.getElementById('signature-input');
    const ctx = canvas.getContext('2d');

    // Configurar el canvas para que sea responsivo y evite desalineación
    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        ctx.scale(ratio, ratio);
    }

    resizeCanvas();

    // Variables de dibujo
    let drawing = false;

    // Funciones de dibujo
    canvas.addEventListener('mousedown', (e) => {
        const rect = canvas.getBoundingClientRect();
        drawing = true;
        ctx.beginPath();
        ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
    });

    canvas.addEventListener('mousemove', (e) => {
        if (drawing) {
            const rect = canvas.getBoundingClientRect();
            ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
            ctx.stroke();
        }
    });

    canvas.addEventListener('mouseup', () => {
        drawing = false;
        signatureInput.value = canvas.toDataURL(); // Guarda la firma en base64
    });

    canvas.addEventListener('mouseout', () => {
        drawing = false;
    });

    // Limpiar la firma
    function clearSignature() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        signatureInput.value = '';
    }
</script>
