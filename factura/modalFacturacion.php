<!-- Modal Factura -->
<div id="fromModalFactura" class="modal modal-fixed-footer" >
    <div class="modal-header">
        <h4> CONFIRMACION DE LA COMPRA</h4>
        <div class="progress">
            <div v-bind:class="[cargando ? 'indeterminate': 'determinate']"></div>
        </div>
    </div>
    <div class="modal-content">
        <div class="row">
            <div class="input-field col s10">
                <input placeholder="" disabled id="nombres" type="text" v-model="usuario.nombres">
                <label for="nombres">Nombre del comprador</label>
            </div>
            <div class="input-field col s2">
                <input placeholder="" disabled id="items" type="text" v-model="items">
                <label for="items">Items</label>
            </div>
            <div class="input-field col s12">
                <input placeholder="" disabled id="correo" type="text" v-model="usuario.correo">
                <label for="correo">Correo de contacto</label>
            </div>
            <div class="input-field col s12" >
                <select v-model="targeta">
                    <option v-for="item in usuario.tarjetas" :value="item.id">{{item.numero}}</option>
                </select>
                <label>Escoga la tarjeta con la que desea cancelar</label>
            </div>
            <div class="input-field col s12">
                <label>El total de la factura es <b> $ {{total}}</b>
                 UNA VEZ ACEPTADA LA COMPRA NO HABDRA DEVOLUCIONES</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-red btn-flat">CANCELAR</a>
        <a href="#!" class="waves-effect waves-green btn-flat" v-on:click="crear()">GUARDAR</a>
    </div>
</div>