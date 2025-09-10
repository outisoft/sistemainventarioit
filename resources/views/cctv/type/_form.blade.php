<div class="row">
    <div class="mb-3">
        <label for="name" class="form-label required-field">Nombre</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            value="{{ old('name', $type->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">Nombre único para identificar el tipo de cámara.</div>
    </div>
</div>
