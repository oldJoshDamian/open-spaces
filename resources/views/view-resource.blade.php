<x-app-layout>
    <div id="adobe-dc-view" style="width: 100%;"></div>
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
                    fileName: "<<PDF File Name>>"
                }
            });
        });

    </script>
</x-app-layout>
