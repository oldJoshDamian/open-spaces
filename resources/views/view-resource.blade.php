<x-app-layout>
    <div id="adobe-dc-view"></div>
    <script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
    <script type="text/javascript">
        document.addEventListener("adobe_dc_view_sdk.ready", function() {
            var adobeDCView = new AdobeDC.View({
                clientId: "{{ env('ADOBE_CLIENT_ID') }}"
                , divId: "adobe-dc-view"
            });
            adobeDCView.previewFile({
                content: {
                    location: {
                        url: "https://ipfs.io/ipfs/{{ $resource }}"
                    }
                }
                , metaData: {
                    fileName: "Bodea Brochure.pdf"
                }
            }, {});
        });

    </script>
</x-app-layout>
