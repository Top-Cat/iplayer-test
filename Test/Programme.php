<?php

class Test_Programme extends Test_Test {

	const TEST_JSON = "{\"id\":\"p02kt4v9\",\"initial_children\":[{\"id\":\"p02td2pn\",\"type\":\"episode\",\"title\":\"100 Lle\",\"lexical_sort_letter\":\"0-9\",\"synopses\":{\"small\":\"Ymweld ag Llanandras, Llangors, Llananno a chrud Methodistiaeth yn Trefeca. Hefyd taith...\",\"medium\":\"Ymweld ag Llanandras, Llangors, Llananno a chrud Methodistiaeth yn Trefeca. Hefyd taith weledol i'r Pales. We visit Llanandras, Llangorse, Llananno Church and the Neo-gothic Tre...\",\"large\":\"Ymweld ag Llanandras, Llangors, Llananno a chrud Methodistiaeth yn Trefeca. Hefyd taith weledol i'r Pales. We visit Llanandras, Llangorse, Llananno Church and the Neo-gothic Trefeca.\"},\"tleo_id\":\"p02kt4v9\",\"tleo_type\":\"series\",\"images\":{\"standard\":\"http://ichef.bbci.co.uk/images/ic/{recipe}/p02vbkpm.jpg\",\"type\":\"image\"},\"guidance\":false,\"related_links\":[],\"subtitle\":\"Pennod 15\",\"release_date\":\"13 Sep 2011\",\"parent_id\":\"p02kt4v9\",\"master_brand\":{\"id\":\"s4cpbs\",\"attribution\":\"s4c\",\"titles\":{\"small\":\"S4C\",\"medium\":\"S4C\",\"large\":\"S4C\"}},\"versions\":[{\"type\":\"version\",\"id\":\"p02td2ps\",\"hd\":false,\"download\":false,\"availability\":{\"start\":\"2015-06-21T21:30:00Z\",\"end\":\"2015-07-21T21:30:00Z\",\"remaining\":{\"text\":\"Available for 26 days\"}},\"kind\":\"original\",\"duration\":{\"value\":\"PT23M13S\",\"text\":\"23 mins\"},\"first_broadcast\":\"13 Sep 2011\"}],\"status\":\"available\"}],\"tleo_type\":\"series\",\"type\":\"programme_large\",\"title\":\"100 Lle\",\"synopses\":{\"small\":\"Aled Samuel sy'n ein tywys drwy 100 lle yng Nghymru i'w gweld cyn marw. Aled Samuel gui...\",\"medium\":\"Aled Samuel sy'n ein tywys drwy 100 lle yng Nghymru i'w gweld cyn marw. Aled Samuel guides us through 100 places in Wales to see before you die.\",\"large\":\"Aled Samuel sy'n ein tywys drwy 100 lle yng Nghymru i'w gweld cyn marw. Aled Samuel guides us through 100 places in Wales to see before you die.\"},\"status\":\"available\",\"images\":{\"standard\":\"http://ichef.bbci.co.uk/images/ic/{recipe}/p02kwb56.jpg\",\"type\":\"image\"},\"lexical_sort_letter\":\"0-9\",\"master_brand\":{\"id\":\"s4cpbs\",\"attribution\":\"s4c\",\"titles\":{\"small\":\"S4C\",\"medium\":\"S4C\",\"large\":\"S4C\"}},\"count\":3}";

	function getName() {
		return "Programmes";
	}

	function doTest() {
		$json = json_decode(self::TEST_JSON);
		$prog = new BBC_Programme($json);

		self::assertEquals($prog->getTitle(), "100 Lle");
	}

}

?>